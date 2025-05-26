<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Mekanik;
use Illuminate\Http\Request;

class MekanikController extends Controller
{
    public function index(){
        $mekaniks = Mekanik::with('role')->get();
        return view('pages.mekanik.index', compact('mekanik'));
    }

    public function create(){
        $roles = Role::all();
        return view('pages.mekanik.create', compact('roles'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:mekanik,name',
            'telepon' => 'required|string',
            'keahlian' => 'required|string',
            'status' => 'required|string'
        ]);

        $mekaniks = Mekanik::create([
            'name' => $validated['name'],
            'telepon' => $validated['telepon'],
            'keahlian' => $validated['keahlian'],
            'status' => $validated['status']
        ]);
        return redirect()->route('mekanik.index');
    }

    public function edit($id) {
        $mekaniks = Mekanik::findOrFail($id);
        $roles = Role::all();

        return view('pages.mekanik.edit', compact(['mekanik', 'roles']));
    }

    public function update(Request $request, $id)
    {
        $mekaniks = Mekanik::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|unique:mekanik,name,' . $id,
            'telepon' => 'required|string',
            'keahlian' => 'required|string',
            'status' => 'required|string'
        ]);

        $mekaniks->update($validated);
        return redirect()->route('mekanik.index')->with('Mekanik berhasil di update');
    }

    public function destroy($id);
    {
        $mekaniks = Mekanik::findOrFail($id);

        if (auth()->id() === $mekaniks->$id) {
            return redirect()->route('mekanik.index')->with('error', 'Tidak dapat menghapus data.');
        }

        $mekaniks->delete();

        return redirect()->route('mekanik.index')->with('Mekanik berhasil dihapus.');
    }
}
