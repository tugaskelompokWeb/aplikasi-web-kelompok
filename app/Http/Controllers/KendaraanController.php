<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::with('pelanggan')->get();
        return view('pages.kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        return view('pages.kendaraan.create', compact('pelanggans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_plat' => 'required',
            'merek' => 'required|string',
            'tipe' => 'required|string',
            'warna' => 'required|string',
            'tahun' => 'required|string',
            'pelanggan_id' => 'required|exists:pelanggan,id'
        ]);

        Kendaraan::create($validated);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $pelanggans = Pelanggan::all();

        return view('pages.kendaraan.edit', compact('kendaraan', 'pelanggans'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $validated = $request->validate([
            'no_plat' => 'required',
            'merek' => 'required|string',
            'tipe' => 'required|string',
            'warna' => 'required|string',
            'tahun' => 'required|integer',
            'pelanggan_id' => 'required|exists:pelanggan,id'
        ]);

        $kendaraan->update($validated);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        // Logika berikut bisa dihapus jika tidak relevan
        if (auth()->id() === $kendaraan->id) {
            return redirect()->route('kendaraan.index')->with('error', 'Tidak dapat menghapus data sendiri.');
        }

        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}
