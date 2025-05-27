<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
<<<<<<< Updated upstream
use App\Models\Role;
use App\Models\Mekanik;
use App\Models\Pelanggan;
=======
>>>>>>> Stashed changes
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
<<<<<<< Updated upstream
    public function index()
    {
        $kendaraans = Kendaraan::with('pelanggan')->get();
        return view('pages.kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('pages.kendaraan.create');
=======
    public function index(){
        $kendaraans = Kendaraan::with('pelanggan')->get();
        return view('pages.kendaraan.index', compact('kendaraan'));
    }

    public function create(){
        return view('pages.kendaraan.create', compact('kendaraan'));
>>>>>>> Stashed changes
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_plat' => 'required',
            'merk' => 'required|string',
            'tipe' => 'required|string',
            'warna' => 'required|string',
            'tahun' => 'required',
            'id_pelanggan' => 'required'
        ]);

        $kendaraans = Kendaraan::create([
            'no_plat' => $validated['no_plat'],
            'merk' => $validated['merk'],
            'tipe' => $validated['tipe'],
            'warna' => $validated['warna'],
            'tahun' => $validated['tahun'],
            'id_pelanggan' => $validated['id_pelanggan'],
        ]);
        return redirect()->route('kendaraan.index');
    }

    public function edit($id) {
        $kendaraans = Kendaraan::findOrFail($id);
<<<<<<< Updated upstream
        $pelanggans = Pelanggan::all();

        return view('pages.kendaraan.edit', compact(['kendaraan', 'pelanggans']));
=======

        return view('pages.kendaraan.edit', compact(['kendaraan']));
>>>>>>> Stashed changes
    }

    public function update(Request $request, $id)
    {
        $kendaraans = Kendaraan::findOrFail($id);

        $validated = $request->validate([
            'no_plat' => 'required',
            'merk' => 'required|string',
            'tipe' => 'required|string',
            'warna' => 'required|string',
            'tahun' => 'required',
            'id_pelanggan' => 'required'
        ]);

        $kendaraans->update($validated);
        return redirect()->route('kendaraan.index')->with('Kendaraan berhasil di update');
    }

    public function destroy($id)
    {
        $kendaraans = Kendaraan::findOrFail($id);

        if (auth()->id() === $kendaraans->$id) {
            return redirect()->route('kendaraan.index')->with('error', 'Tidak dapat menghapus data.');
        }

        $kendaraans->delete();

        return redirect()->route('kendaraan.index')->with('Kendaraan berhasil dihapus.');
    }
}
