<?php

namespace App\Http\Controllers;

use App\Models\JasaService;
use App\Models\Kendaraan;
use App\Models\Mekanik;
use App\Models\Servis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Servis::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->WhereHas('Mekanik', function ($q2) use ($search) {
                  $q2->where('nama', 'like', "%$search%");
              });
        });
    }

    $servis = $query->paginate(10)->withQueryString();
        return view('pages.servis.index', compact('servis'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mekanik = Mekanik::all();
        $kendaraan = Kendaraan::all();
        return view('pages.servis.create', compact(['mekanik', 'kendaraan']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_datang' => 'required|date',
            'keluhan_awal' => 'required|string',
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'mekanik_id' => 'required|exists:mekanik,id',
            'jasa' => 'required|array',
            'jasa.*.nama_jasa' => 'required|string',
            'jasa.*.biaya' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $servis = Servis::create([
                'tgl_datang' => $request->tgl_datang,
                'keluhan_awal' => $request->keluhan_awal,
                'status_servis' => 'proses',
                'kendaraan_id' => $request->kendaraan_id,
                'mekanik_id' => $request->mekanik_id,
                'total_biaya' => 0,
            ]);

            $totalBiaya = 0;
            foreach ($request->jasa as $jasa) {
                $servis->jasaServis()->create([
                    'servis_id' => $servis->id,
                    'nama_jasa' => $jasa['nama_jasa'],
                    'biaya' => $jasa['biaya'],
                ]);
                $totalBiaya += $jasa['biaya'];
            }
            $servis->update(['total_biaya' => $totalBiaya]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan servis: ' . $e->getMessage()]);
        }

        return redirect()->route('servis.index')->with('success', 'Servis berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $servis = Servis::with(['mekanik', 'kendaraan', 'jasaServis'])->findOrFail($id);
        return view('pages.servis.detail', compact('servis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $servis = Servis::with('jasaServis')->findOrFail($id);
        $mekanik = Mekanik::all();
        $kendaraan = Kendaraan::all();
        return view('pages.servis.edit', compact('servis', 'mekanik', 'kendaraan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_keluar' => 'nullable|date',
            'status_servis' => 'required|string',
            'jasa' => 'nullable|array',
            'jasa.*.nama_jasa' => 'required|string',
            'jasa.*.biaya' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $servis = Servis::findOrFail($id);

            if ($request->has('jasa')) {
                JasaService::where('servis_id', $servis->id)->delete();

                $totalBiaya = 0;
                foreach ($request->jasa as $jasa) {
                    JasaService::create([
                        'servis_id' => $servis->id,
                        'nama_jasa' => $jasa['nama_jasa'],
                        'biaya' => $jasa['biaya'],
                    ]);
                    $totalBiaya += $jasa['biaya'];
                }
                $servis->total_biaya = $totalBiaya;
            }

            $servis->status_servis = $request->status_servis;
            $servis->tgl_keluar = $request->tgl_keluar ?? $servis->tgl_keluar;
            $servis->save();

            DB::commit();
            return redirect()->route('servis.index')->with('success', 'Data servis berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Gagal update servis: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $servis = Servis::findOrFail($id);
        JasaService::where('servis_id', $servis->id)->delete();
        $servis->delete();

        return redirect()->route('servis.index')->with('success', 'Servis berhasil dihapus.');
    }
}
