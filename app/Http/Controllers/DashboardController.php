<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on user role.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $userRole = $user->getFirstRoleName();

        switch ($userRole) {
            case 'super_admin':
                return $this->superAdminDashboard();
            
            case 'admin_desa':
                return $this->adminDesaDashboard($user);
            
            case 'admin_kecamatan':
                return $this->adminKecamatanDashboard($user);
            
            case 'admin_kabupaten':
                return $this->adminKabupatenDashboard($user);
            
            default:
                return Inertia::render('dashboard', [
                    'stats' => [],
                    'userRole' => $userRole,
                ]);
        }
    }

    /**
     * Display Super Admin dashboard with overall statistics.
     */
    protected function superAdminDashboard()
    {
        $stats = [
            'total_kabupaten' => Kabupaten::count(),
            'total_kecamatan' => Kecamatan::count(),
            'total_desa' => Desa::count(),
            'total_users' => User::count(),
            'recent_desas' => Desa::with(['kabupaten', 'kecamatan'])
                ->latest()
                ->take(5)
                ->get(),
        ];

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'userRole' => 'super_admin',
        ]);
    }

    /**
     * Display Admin Desa dashboard with village-specific data.
     */
    protected function adminDesaDashboard(User $user)
    {
        if (!$user->desa_id) {
            return Inertia::render('dashboard', [
                'error' => 'No village assigned to this user.',
                'userRole' => 'admin_desa',
            ]);
        }

        $desa = Desa::with(['kabupaten', 'kecamatan'])->find($user->desa_id);
        
        // Count related data
        $totalDemografi = \DB::table('demografis')->where('desa_id', $user->desa_id)->whereNull('deleted_at')->count();
        $totalUmkm = \DB::table('umkms')->where('desa_id', $user->desa_id)->whereNull('deleted_at')->count();
        
        $stats = [
            'desa' => $desa,
            'total_demografi' => $totalDemografi,
            'total_umkm' => $totalUmkm,
        ];

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'userRole' => 'admin_desa',
        ]);
    }

    /**
     * Display Admin Kecamatan dashboard with district summary.
     */
    protected function adminKecamatanDashboard(User $user)
    {
        $stats = [
            'message' => 'Kecamatan dashboard - view summaries of villages in your district',
        ];

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'userRole' => 'admin_kecamatan',
        ]);
    }

    /**
     * Display Admin Kabupaten dashboard with regency overview.
     */
    protected function adminKabupatenDashboard(User $user)
    {
        $stats = [
            'message' => 'Kabupaten dashboard - view all districts and villages overview',
        ];

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'userRole' => 'admin_kabupaten',
        ]);
    }
}