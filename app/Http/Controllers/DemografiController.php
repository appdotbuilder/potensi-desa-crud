<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDemografiRequest;
use App\Http\Requests\UpdateDemografiRequest;
use App\Models\Demografi;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DemografiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Demografi::with('desa.kecamatan.kabupaten');

        // Filter based on user role
        if ($user->hasRole('admin_desa') && $user->desa_id) {
            $query->where('desa_id', $user->desa_id);
        } elseif ($user->hasRole('admin_kecamatan')) {
            // Filter by kecamatan - this would require additional logic
            // For now, show all
        }

        $demografis = $query->when($request->search, function ($query, $search) {
            return $query->whereHas('desa', function ($q) use ($search) {
                $q->where('nama_desa', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(10);

        return Inertia::render('demografi/index', [
            'demografis' => $demografis,
            'filters' => $request->only(['search']),
            'userRole' => $user->getFirstRoleName(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $desas = collect();

        if ($user->hasRole('super_admin')) {
            $desas = Desa::with(['kecamatan', 'kabupaten'])->get();
        } elseif ($user->hasRole('admin_desa') && $user->desa_id) {
            $desas = Desa::where('id', $user->desa_id)->with(['kecamatan', 'kabupaten'])->get();
        }

        return Inertia::render('demografi/create', [
            'desas' => $desas,
            'agamaOptions' => ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'],
            'pendidikanOptions' => ['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'Diploma', 'Sarjana', 'Pascasarjana'],
            'pekerjaanOptions' => ['Petani', 'Pedagang', 'PNS', 'Swasta', 'Nelayan', 'Buruh', 'Lainnya'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDemografiRequest $request)
    {
        $demografi = Demografi::create($request->validated());

        return redirect()->route('demografi.index')
            ->with('success', 'Data demografi created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Demografi $demografi)
    {
        $demografi->load('desa.kecamatan.kabupaten');

        return Inertia::render('demografi/show', [
            'demografi' => $demografi,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demografi $demografi)
    {
        $user = Auth::user();
        $desas = collect();

        if ($user->hasRole('super_admin')) {
            $desas = Desa::with(['kecamatan', 'kabupaten'])->get();
        } elseif ($user->hasRole('admin_desa') && $user->desa_id) {
            $desas = Desa::where('id', $user->desa_id)->with(['kecamatan', 'kabupaten'])->get();
        }

        $demografi->load('desa');

        return Inertia::render('demografi/edit', [
            'demografi' => $demografi,
            'desas' => $desas,
            'agamaOptions' => ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'],
            'pendidikanOptions' => ['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'Diploma', 'Sarjana', 'Pascasarjana'],
            'pekerjaanOptions' => ['Petani', 'Pedagang', 'PNS', 'Swasta', 'Nelayan', 'Buruh', 'Lainnya'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDemografiRequest $request, Demografi $demografi)
    {
        $demografi->update($request->validated());

        return redirect()->route('demografi.index')
            ->with('success', 'Data demografi updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demografi $demografi)
    {
        $demografi->delete();

        return redirect()->route('demografi.index')
            ->with('success', 'Data demografi deleted successfully.');
    }
}