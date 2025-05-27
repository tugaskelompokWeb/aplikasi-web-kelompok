<?php

namespace App\Http\Controllers;

use App\Models\Mekanik;
use Illuminate\Http\Request;

class MekanikController extends Controller
{
    public function index()
    {
        $mekaniks = Mekanik::all();
        return view('pages.mekanik.index', compact('mekaniks'));
    }

    public function create()
    {
        return view('pages.mekanik.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|unique:mekanik,nama',
            'telepon' => 'required|string',
            'keahlian' => 'required|string',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        Mekanik::create($validated);

        return redirect()->route('mekanik.index')->with('success', 'Mekanik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mekanik = Mekanik::findOrFail($id);
        return view('pages.mekanik.edit', compact('mekanik'));
    }

    public function update(Request $request, $id)
    {
        $mekanik = Mekanik::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|unique:mekanik,nama,' . $id,
            'telepon' => 'required|string',
            'keahlian' => 'required|string',
            'status' => 'required|string'
        ]);

        $mekanik->update($validated);

        return redirect()->route('mekanik.index')->with('success', 'Mekanik berhasil diupdate.');
    }

    public function destroy($id)
    {
        $mekanik = Mekanik::findOrFail($id);

        if (auth()->id() === $mekanik->id) {
            return redirect()->route('mekanik.index')->with('error', 'Tidak dapat menghapus data sendiri.');
        }

        $mekanik->delete();

        return redirect()->route('mekanik.index')->with('success', 'Mekanik berhasil dihapus.');
    }
}
