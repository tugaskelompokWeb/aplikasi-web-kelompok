<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garansi;

class GaransiController extends Controller
{
    public function index()
    {
        $garansi = Garansi::all();
        return view('pages.garansi.index', compact('garansi'));
    }

    public function create()
    {
        return view('pages.garansi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk'            => 'required|string',
            'nomor_seri'        => 'required|string|unique:garansi,nomor_seri',
            'tanggal_mulai'     => 'required|date',
            'tanggal_berakhir'  => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan'        => 'nullable|string',
        ]);

        Garansi::create($validated);

        return redirect()->route('garansi.index')->with('success', 'Data garansi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $garansi = Garansi::findOrFail($id);
        return view('pages.garansi.edit', compact('garansi'));
    }

    public function update(Request $request, $id)
    {
        $garansi = Garansi::findOrFail($id);

        $validated = $request->validate([
            'produk'            => 'required|string',
            'nomor_seri'        => 'required|string|unique:garansi,nomor_seri,' . $id,
            'tanggal_mulai'     => 'required|date',
            'tanggal_berakhir'  => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan'        => 'nullable|string',
        ]);

        $garansi->update($validated);

        return redirect()->route('garansi.index')->with('success', 'Data garansi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $garansi = Garansi::findOrFail($id);
        $garansi->delete();

        return redirect()->route('garansi.index')->with('success', 'Data garansi berhasil dihapus');
    }
}
