<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Servis;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['servis.kendaraan','items.barang','user'])->get();
        return view('pages.transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $servis = Servis::where('status_servis', '!=', 'selesai')->get();
        $barang = Barang::all(); // Assuming you have a Barang model to fetch items
        return view('pages.transaksi.create', compact('servis', 'barang'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'servis_id' => 'required|exists:servis,id',
        'metode_pembayaran' => 'required|string',
        'items' => 'required|array|min:1',
        'items.*.barang_id' => 'required|exists:barang,id',
        'items.*.jumlah' => 'required|integer|min:1',
        'items.*.harga_satuan' => 'required|numeric|min:0',
    ]);

    DB::beginTransaction();
    try {
        $servis = Servis::findOrFail($request->servis_id);
        if ($servis->status_servis === 'selesai') {
            return redirect()->back()->with('error', 'Servis sudah selesai, tidak dapat membuat transaksi baru.');
        }

        $noTransaksi = $this->generateNoTransaksi();

        $transaksi = new Transaksi();
        $transaksi->no_transaksi = $noTransaksi;
        $transaksi->servis_id = $request->servis_id;
        $transaksi->user_id = auth()->id();
        $transaksi->metode_pembayaran = $request->metode_pembayaran;
        $transaksi->tanggal = Carbon::now();
        $transaksi->save();

        $totalItems = 0;
        if ($request->has('items')) {
            foreach ($request->items as $item) {
                $transaksiItem = new TransaksiItem();
                $transaksiItem->transaksi_id = $transaksi->id;
                $transaksiItem->barang_id = $item['barang_id'];
                $transaksiItem->jumlah = $item['jumlah'];
                $transaksiItem->harga_satuan = $item['harga_satuan'];
                $transaksiItem->save();
                $totalItems += $item['jumlah'] * $item['harga_satuan'];
            }
        }

        $transaksi->total_harga = $servis->total_biaya + $totalItems;
        $transaksi->save();

        $servis->status_servis = 'selesai';
        $servis->tgl_keluar = Carbon::now();
        $servis->save();

        DB::commit();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Transaksi gagal: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Transaksi gagal dibuat: ' . $e->getMessage());
    }
}

    private function generateNoTransaksi()
    {
        $waktu= Carbon::now()->format('Ymd');
        $transaksiTerakhir = Transaksi::whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->first();
        if ($transaksiTerakhir){
            $nomorTerakhir = (int)substr($transaksiTerakhir->no_transaksi, -3);
            $nomorBaru = $nomorTerakhir + 1;
        } else {
            $nomorBaru = 1;
        }
        return 'TRX' . $waktu . str_pad($nomorBaru, 3, '0', STR_PAD_LEFT);
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['servis', 'user', 'items.barang'])->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }
}
