<?php

namespace App\Http\Controllers;

<<<<<<< Updated upstream
use App\Models\Role;
use App\Models\Pelanggan;
=======
use App\Models\Pelanggan; 
>>>>>>> Stashed changes
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(){
        $pelanggans = Pelanggan::all();
        return view('pages.pelanggan.index', compact('pelanggans'));
    }

    public function create(){
<<<<<<< Updated upstream
        return view('pages.pelanggan.create');
=======
        return view('pages.pelanggan.create', compact('pelanggan'));
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
        return view('pages.pelanggan.edit', compact('pelanggans'));
=======
        return view('pages.pelanggan.edit', compact(['pelanggan']));
>>>>>>> Stashed changes
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

    public function destroy($id)
    {
        $pelanggans = Pelanggan::findOrFail($id);

        if (auth()->id() === $pelanggans->$id) {
            return redirect()->route('pelanggan.index')->with('error', 'Tidak dapat menghapus data.');
        }

        $pelanggans->delete();

        return redirect()->route('pelanggan.index')->with('Pelanggan berhasil dihapus.');
    }
}
