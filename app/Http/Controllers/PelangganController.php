<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Pelanggan; 
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(){
        $pelanggans = User::with('role')->get();
        return view('pages.pelanggan.index', compact('pelanggan'));
    }

    public function create(){
        $roles = Role::all();
        return view('pages.pelanggan.create', compact('roles'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:pelanggan,name',
            'alamat' => 'required|unique:pelanggan,alamat',
            'telepon' => 'required|string',
            'email' => 'required|unique:pelanggan,email',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required|string'
        ]);

        $pelanggans = Pelanggan::create([
            'name' => $validated['name'],
            'alamat' => $validated['alamat'],
            'telepon' => $validated['telepon'],
            'email' => $validated['email'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
        ]);
        return redirect()->route('pelanggan.index');
    }

    public function edit($id) {
        $pelanggans = Pelanggan::findOrFail($id);
        $roles = Role::all();

        return view('pages.pelanggan.edit', compact(['pelanggan', 'roles']));
    }

    public function update(Request $request, $id)
    {
        $pelanggans = Pelanggan::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|unique:pelanggan,name,' . $id,
            'alamat' => 'required|unique:pelanggan,alamat',
            'telepon' => 'required|string',
            'email' => 'required|unique:pelanggan,email',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required|string'
        ]);

        $pelanggans->update($validated);
        return redirect()->route('pelanggan.index')->with('Pelanggan berhasil di update');
    }

    public function destroy($id);
    {
        $pelanggans = Pelanggan::findOrFail($id);

        if (auth()->id() === $pelanggans->$id) {
            return redirect()->route('pelanggan.index')->with('error', 'Tidak dapat menghapus data.');
        }

        $pelanggans->delete();

        return redirect()->route('pelanggan.index')->with('Pelanggan berhasil dihapus.');
    }
}
