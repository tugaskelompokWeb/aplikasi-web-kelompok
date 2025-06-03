<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Servis;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['pelanggan.kendaraan','items.barang','user'])->get();
        return view('pages.transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $servis = Servis::all();
        $barang = Barang::all();
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

        DB::transaction();
        try {
            $noTransaksi = $this->generateNoTransaksi();

            $totalHarga = 0;
            foreach ($request->items as $item) {
                $totalHarga += $item['jumlah'] * $item['harga_satuan'];
            }

            $transaksi = Transaksi::create([
                'no_transaksi' => $noTransaksi,
                'servis_id' => $request->servis_id,
                'user_id' => auth()->id(),
                'metode_pembayaran' => $request->metode_pembayaran,
                'created_at' => Carbon::now(),
                'total_harga' => $totalHarga,
            ]);

            foreach ($request->items as $item) {
                TransaksiItem::create([
                    'barang_id' => $item['barang_id'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga_satuan'],
                ]);
            }
            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
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
}
