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
        $mekaniks = Mekanik::all();

        return view('mekanik.index')->with('mekanik', $mekaniks);
    }

    public function create()
    {
        return view('mekanik.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'nama' => 'required|unique:mekanik',
            'telepon' => 'required',
            'keahlian' => 'required',
            'status' => 'required'
        ]);

        //simpan ke tabel Mekaniks
        Mekanik::create($input);

        return redirect()->route('mekanik.index')
                         ->with('success', 'Mekanik berhasil disimpan');
    }

    public function show(Mekanik $mekaniks)
    {
        //
    }
    
    public function edit(Mekanik $mekaniks)
    {
        //
    }

    public function update(Request $request, Mekanik $mekaniks)
    {
        //
    }
    
    public function destroy(Mekanik $mekaniks)
    {
        //
    }

}