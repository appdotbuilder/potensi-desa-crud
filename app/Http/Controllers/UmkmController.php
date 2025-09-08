<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUmkmRequest;
use App\Http\Requests\UpdateUmkmRequest;
use App\Models\Umkm;
use App\Models\Desa;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        $query = Umkm::with(['desa.kecamatan.kabupaten']);
        
        // Apply role-based filtering
        if ($user->hasRole('admin_desa')) {
            $query->where('desa_id', $user->desa_id);
        } elseif ($user->hasRole('admin_kecamatan')) {
            $query->whereHas('desa', fn($q) => $q->where('kecamatan_id', $user->kecamatan_id));
        } elseif ($user->hasRole('admin_kabupaten')) {
            $query->whereHas('desa', fn($q) => $q->where('kabupaten_id', $user->kabupaten_id));
        }
        
        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_usaha', 'LIKE', "%{$search}%")
                  ->orWhere('pemilik', 'LIKE', "%{$search}%")
                  ->orWhere('jenis_usaha', 'LIKE', "%{$search}%");
            });
        }
        
        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $umkms = $query->latest()->paginate(15);
        
        return Inertia::render('umkms/index', [
            'umkms' => $umkms,
            'can_create' => $user->hasRole('admin_desa') || $user->isSuperAdmin(),
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = $request->user();
        
        if (!$user->hasRole('admin_desa') && !$user->isSuperAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        
        $desaOptions = $user->isSuperAdmin() 
            ? Desa::with(['kecamatan', 'kabupaten'])->get()
            : Desa::where('id', $user->desa_id)->with(['kecamatan', 'kabupaten'])->get();
        
        return Inertia::render('umkms/create', [
            'desa_options' => $desaOptions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUmkmRequest $request)
    {
        $umkm = Umkm::create($request->validated());

        return redirect()->route('umkms.show', $umkm)
            ->with('success', 'Data UMKM berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Umkm $umkm)
    {
        $umkm->load(['desa.kecamatan.kabupaten']);
        
        return Inertia::render('umkms/show', [
            'umkm' => $umkm,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Umkm $umkm)
    {
        $user = $request->user();
        
        // Check permission
        if ($user->hasRole('admin_desa') && $umkm->desa_id !== $user->desa_id) {
            abort(403, 'Unauthorized action.');
        }
        
        $umkm->load(['desa.kecamatan.kabupaten']);
        
        $desaOptions = $user->isSuperAdmin() 
            ? Desa::with(['kecamatan', 'kabupaten'])->get()
            : Desa::where('id', $user->desa_id)->with(['kecamatan', 'kabupaten'])->get();
        
        return Inertia::render('umkms/edit', [
            'umkm' => $umkm,
            'desa_options' => $desaOptions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUmkmRequest $request, Umkm $umkm)
    {
        $umkm->update($request->validated());

        return redirect()->route('umkms.show', $umkm)
            ->with('success', 'Data UMKM berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Umkm $umkm)
    {
        $user = $request->user();
        
        // Check permission
        if ($user->hasRole('admin_desa') && $umkm->desa_id !== $user->desa_id) {
            abort(403, 'Unauthorized action.');
        }
        
        $umkm->delete();

        return redirect()->route('umkms.index')
            ->with('success', 'Data UMKM berhasil dihapus.');
    }
}