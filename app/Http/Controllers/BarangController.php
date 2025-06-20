<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    public function index(Request $request)
    {
    $query = Barang::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%$search%")
              ->orWhere('kode_barang', 'like', "%$search%");
        });
    }
    $barangs = $query->paginate(10)->withQueryString();
        return view('pages.barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('pages.barang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang',
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);
        Barang::create($validated);

        Alert::success('Barang berhasil ditambahkan');
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('pages.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $validated = $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang',
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);
        $barang->update($validated);

        Alert::success('Barang berhasil diupdate.');
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        Alert::success('Barang berhasil dihapus.');
        return redirect()->route('barang.index');
    }
}
