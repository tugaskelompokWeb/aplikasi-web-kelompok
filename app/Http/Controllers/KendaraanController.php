<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //akses model Kendaraan
        $kendaraans = Kendaraan::all();

        return view('kendaraan.index')->with('kendaraan', $kendarans);
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'no_plat' => 'required|unique:kendaraan',
            'merk' => 'required',
            'tipe' => 'required',
            'warna' => 'required',
            'tahun' => 'required',
            'id_pelanggan' => 'required'
        ]);

        //simpan ke tabel Kendaraan
        Kendaraan::create($input);

        return redirect()->route('kendaraan.index')
                         ->with('success', 'Kendaraan berhasil disimpan');
    }

    public function show(Kendaraan $kendaraans)
    {
        //
    }
    
    public function edit(Kendaraan $kendaraans)
    {
        //
    }

    public function update(Request $request, Kendaraan $kendaraans)
    {
        //
    }
    
    public function destroy(Kendaraan $kendaraans)
    {
        //
    }

}