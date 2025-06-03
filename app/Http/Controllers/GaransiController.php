<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garansi;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use App\Models\User;

class GaransiController extends Controller
{
    public function index()
    {
        $garansi = Garansi::with(['pelanggan', 'kendaraan', 'user'])->get();
        return view('pages.garansi.index', compact('garansi'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $kendaraans = Kendaraan::all();
        return view('pages.garansi.create', compact('pelanggans', 'kendaraans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id'      => 'required|exists:pelanggan,id',
            'kendaraan_id'      => 'required|exists:kendaraan,id',
            'tanggal_garansi'   => 'required',
            'keluhan'           => 'nullable|string|max:255',
            'batas_akhir'       => 'nullable',
            'status'            => 'required|in:aktif,kadaluarsa,batal',
        ]);

        $validated['user_id'] = auth()->id();
        Garansi::create($validated);

        return redirect()->route('garansi.index')->with('success', 'Data garansi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $garansi = Garansi::findOrFail($id);
        $pelanggans = Pelanggan::all();
        $kendaraans = Kendaraan::all();
        return view('pages.garansi.edit', compact(['garansi', 'pelanggans', 'kendaraans']));
    }

    public function update(Request $request, $id)
    {
        $garansi = Garansi::findOrFail($id);

        $validated = $request->validate([
            'pelanggan_id'      => 'required|exists:pelanggan,id',
            'kendaraan_id'      => 'required|exists:kendaraan,id',
            'tanggal_garansi'   => 'required',
            'keluhan'           => 'nullable|string|max:255',
            'batas_akhir'       => 'nullable',
            'status'            => 'required|in:aktif,kadaluarsa,batal',
        ]);

        $validated['user_id'] = auth()->id();
        $garansi->update($validated);

        return redirect()->route('garansi.index')->with('success', 'Data garansi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $garansi = Garansi::findOrFail($id);
        $garansi->delete();

        return redirect()->route('garansi.index')->with('success', 'Data garansi berhasil dihapus');
    }
}
