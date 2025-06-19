<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('pages.pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pages.pelanggan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|unique:pelanggan,nama',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'required|unique:pelanggan,email',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|string'
        ]);

        Pelanggan::create($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pages.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|unique:pelanggan,nama,' . $id,
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'required|unique:pelanggan,email,' . $id,
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required|string'
        ]);

        $pelanggan->update($validated);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        if (auth()->id() === $pelanggan->id) {
            return redirect()->route('pelanggan.index')->with('error', 'Tidak dapat menghapus data sendiri.');
        }

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
