<?php

namespace App\Http\Controllers;

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
}
