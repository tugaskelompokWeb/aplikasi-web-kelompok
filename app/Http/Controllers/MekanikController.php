<?php

namespace App\Http\Controllers;

use App\Models\Mekanik;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MekanikController extends Controller
{
    public function index(Request $request)
    {
    $query = Mekanik::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%$search%")
              ->orWhere('status', 'like', "%$search%");
        });
    }
    $mekaniks = $query->paginate(10)->withQueryString();
        return view('pages.mekanik.index', compact('mekaniks'));
    }

    public function create()
    {
        $mekaniks = Mekanik::all();
        return view('pages.mekanik.create', compact('mekaniks'));
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

    public function destroy(string $id)
    {
        $mekanik = Mekanik::findOrFail($id);



        $mekanik->delete();

        Alert::success('Transaksi berhasil dihapus.');
        return redirect()->route('transaksi.index');
    }
}
