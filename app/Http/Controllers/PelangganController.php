<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //akses model Mekanik
        $pelanggans = Pelanggan::all();

        return view('pelanggan.index')->with('pelanggan', $pelanggans);
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'nama' => 'required|unique:pelanggan',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'email',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required'
        ]);

        //simpan ke tabel Pelanggan
        Pelanggan::create($input);

        return redirect()->route('pelanggan.index')
                         ->with('success', 'pelanggan berhasil disimpan');
    }

    public function show(Pelanggan $pelanggans)
    {
        //
    }
    
    public function edit(Pelanggan $pelanggans)
    {
        //
    }

    public function update(Request $request, Pelanggan $pelanggans)
    {
        //
    }
    
    public function destroy(Pelanggan $pelanggans)
    {
        //
    }

}