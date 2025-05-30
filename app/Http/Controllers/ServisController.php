<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Mekanik;
use App\Models\Servis;
use Illuminate\Http\Request;

class ServisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servis = Servis::with(['mekanik', 'kendaraan']);
        return view('pages.servis.index', compact('servis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mekanik = Mekanik::all();
        $kendaraan = Kendaraan::all();
        return view('pages.servis.create', compact(['mekanik', 'kendaraan']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tgl_datang' => 'required',
            'tgl_keluar' => 'required',
            'total_biaya' => 'required',
            'keluhan_awal' => 'required',
            'status_servis' => 'required',
            'kendaraan_id' => 'required|exists,kendaraan',
            'mekanik_id' => 'required|exists,mekanik'
        ]);

        Servis::create($validated);

        return redirect()->route('servis.index')->with('success', 'Servis berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $servis = Servis::findOrFail($id);
        $mekanik = Mekanik::all();
        $kendaraan = Kendaraan::all();
        return view('pages.servis.edit', compact(['servis', 'mekanik', 'kendaraan']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $servis = Servis::findOrFail($id);

        $validated = $request->validate([
            'tgl_datang' => 'required',
            'tgl_keluar' => 'required',
            'total_biaya' => 'required',
            'keluhan_awal' => 'required',
            'status_servis' => 'required',
            'kendaraan_id' => 'required|exists,kendaraan',
            'mekanik_id' => 'required|exists,mekanik'
        ]);

        $servis->update($validated);

        return redirect()->route('servis.index')->with('success', 'Servis berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $servis = Servis::findOrFail($id);
        $servis->delete();

        return redirect()->route('servis.index')->with('success', 'Servis berhasil dihapus.');
    }
}
