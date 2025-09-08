<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKabupatenRequest;
use App\Http\Requests\UpdateKabupatenRequest;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kabupatens = Kabupaten::with('kecamatans')
            ->when($request->search, function ($query, $search) {
                return $query->where('nama_kabupaten', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return Inertia::render('kabupaten/index', [
            'kabupatens' => $kabupatens,
            'filters' => $request->only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('kabupaten/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKabupatenRequest $request)
    {
        $kabupaten = Kabupaten::create($request->validated());

        return redirect()->route('kabupaten.index')
            ->with('success', 'Kabupaten created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kabupaten $kabupaten)
    {
        $kabupaten->load(['kecamatans.desas']);

        return Inertia::render('kabupaten/show', [
            'kabupaten' => $kabupaten,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kabupaten $kabupaten)
    {
        return Inertia::render('kabupaten/edit', [
            'kabupaten' => $kabupaten,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKabupatenRequest $request, Kabupaten $kabupaten)
    {
        $kabupaten->update($request->validated());

        return redirect()->route('kabupaten.index')
            ->with('success', 'Kabupaten updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kabupaten $kabupaten)
    {
        $kabupaten->delete();

        return redirect()->route('kabupaten.index')
            ->with('success', 'Kabupaten deleted successfully.');
    }
}