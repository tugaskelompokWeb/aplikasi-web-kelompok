<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'name'  => 'required',
            'password' => 'required|string'
        ]);

        $users = User::where('name', $request->name)->first();

        if (!$users) {
            return redirect()->back()->with('User Tidak ada');
        }

        auth()->login($users);

        return redirect()->route('dashboard')->with('success', 'Login berhasil');
    }

    public function index(){
        $users = User::with('role')->get();
        return view('pages.users.index', compact('users'));
    }

    public function create(){
        $roles = Role::all();
        return view('pages.users.create', compact('roles'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name'      => 'required|unique:users,name',
            'email'     => 'required|unique:users,email',
            'password'  => 'required|string|min:3|confirmed',
            'role_id'   => 'required|exists:roles,id',
            'no_telp'   => 'required|string',
            'posisi'    => 'required|string',
            'alamat'    => 'required|string'
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role_id'  => $validated['role_id'],
            'no_telp'  => $validated['no_telp'],
            'posisi'   => $validated['posisi'],
            'alamat'   => $validated['alamat'],
        ]);

        return redirect()->route('users.index');
    }

    public function edit($id) {
        $users = User::findOrFail($id);
        $roles = Role::all();

        return view('pages.users.edit',compact(['users','roles']));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|unique:users,name,' . $id,
            'email'    => 'required|email|unique:users,email,' . $id,
            'role_id'  => 'required|exists:roles,id',
            'no_telp'  => 'required|string',
            'posisi'   => 'required|string',
            'alamat'   => 'required|string',
        ]);

        $user->update($validated);
        return redirect()->route('users.index')->with('User berhasil di update');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'Kamu tidak bisa menghapus akunmu sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('User berhasil dihapus.');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form')->with('success', 'Logout berhasil');
    }


}
