<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\User;
use App\Models\Demografi;
use App\Models\Umkm;
use App\Models\FasilitasUmum;
use App\Models\Pendidikan;
use App\Models\Kesehatan;
use App\Models\PariwisataBudaya;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        if ($user->isSuperAdmin()) {
            return $this->superAdminDashboard();
        } elseif ($user->hasRole('admin_kabupaten')) {
            return $this->adminKabupatenDashboard($user);
        } elseif ($user->hasRole('admin_kecamatan')) {
            return $this->adminKecamatanDashboard($user);
        } elseif ($user->hasRole('admin_desa')) {
            return $this->adminDesaDashboard($user);
        }

        return Inertia::render('dashboard', [
            'stats' => []
        ]);
    }

    /**
     * Super admin dashboard with overall statistics.
     */
    protected function superAdminDashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_desa' => Desa::count(),
            'total_umkm' => Umkm::count(),
            'total_penduduk' => Demografi::sum('total_penduduk'),
            'recent_users' => User::with(['role', 'desa'])->latest()->limit(5)->get(),
            'desa_stats' => Desa::with(['kecamatan', 'kabupaten'])
                ->withCount(['umkms', 'demografis', 'fasilitasUmums'])
                ->latest()
                ->limit(10)
                ->get(),
        ];

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'role_type' => 'super_admin'
        ]);
    }

    /**
     * Admin kabupaten dashboard.
     */
    protected function adminKabupatenDashboard(User $user)
    {
        $desaQuery = Desa::where('kabupaten_id', $user->kabupaten_id);
        
        $stats = [
            'total_desa' => $desaQuery->count(),
            'total_umkm' => Umkm::whereIn('desa_id', $desaQuery->pluck('id'))->count(),
            'total_penduduk' => Demografi::whereIn('desa_id', $desaQuery->pluck('id'))->sum('total_penduduk'),
            'desa_list' => $desaQuery->with(['kecamatan'])
                ->withCount(['umkms', 'demografis'])
                ->get(),
        ];

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'role_type' => 'admin_kabupaten'
        ]);
    }

    /**
     * Admin kecamatan dashboard.
     */
    protected function adminKecamatanDashboard(User $user)
    {
        $desaQuery = Desa::where('kecamatan_id', $user->kecamatan_id);
        
        $stats = [
            'total_desa' => $desaQuery->count(),
            'total_umkm' => Umkm::whereIn('desa_id', $desaQuery->pluck('id'))->count(),
            'total_penduduk' => Demografi::whereIn('desa_id', $desaQuery->pluck('id'))->sum('total_penduduk'),
            'desa_list' => $desaQuery->withCount(['umkms', 'demografis'])->get(),
        ];

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'role_type' => 'admin_kecamatan'
        ]);
    }

    /**
     * Admin desa dashboard.
     */
    protected function adminDesaDashboard(User $user)
    {
        $desa = $user->desa;
        
        if (!$desa) {
            return Inertia::render('dashboard', [
                'stats' => [],
                'error' => 'Desa tidak ditemukan'
            ]);
        }

        $stats = [
            'desa_name' => $desa->nama_desa,
            'total_umkm' => $desa->umkms()->count(),
            'total_penduduk' => $desa->demografis()->sum('total_penduduk'),
            'total_fasilitas' => $desa->fasilitasUmums()->count(),
            'total_sekolah' => $desa->pendidikans()->count(),
            'total_kesehatan' => $desa->kesehatans()->count(),
            'total_pariwisata' => $desa->pariwisataBudayas()->count(),
            'recent_data' => [
                'umkm' => $desa->umkms()->latest()->limit(5)->get(),
                'pariwisata' => $desa->pariwisataBudayas()->latest()->limit(3)->get(),
            ],
        ];

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'role_type' => 'admin_desa'
        ]);
    }
}