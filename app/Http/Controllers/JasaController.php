<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JasaController extends Controller
{
    public function index(Request $request)
    {
    $query = Jasa::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama_jasa', 'like', "%$search%");
        });
    }
    $jasa = $query->paginate(10);
        return view('pages.jasa.index', compact('jasa'));
    }

    public function create()
    {
        $jasa = Jasa::all();
        return view('pages.jasa.create', compact('jasa'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jasa' => 'required|unique:jasa,nama_jasa',
            'biaya'     => 'required|numeric',
        ]);

        Jasa::create($validated);

        return redirect()->route('jasa.index')->with('success', 'Mekanik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jasa = Jasa::findOrFail($id);
        return view('pages.jasa.edit', compact('jasa'));
    }

    public function update(Request $request, $id)
    {
        $jasa = Jasa::findOrFail($id);

        $validated = $request->validate([
            'nama_jasa' => 'required|unique:jasa,nama_jasa,' . $id,
            'biaya' => 'required|numeric'
        ]);

        $jasa->update($validated);

        Alert::success('Jasa berhasil di update');
        return redirect()->route('jasa.index');
    }

    public function destroy(string $id)
    {
        $jasa = Jasa::findOrFail($id);



        $jasa->delete();

        Alert::success('Jasa berhasil dihapus.');
        return redirect()->route('jasa.index');
    }
}
