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
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    public function index(Request $request){
        $query = Transaksi::query();


        if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('no_transaksi', 'like', "%$search%");
        });
    }

    $transaksis = $query->paginate(10)->withQueryString();
        return view('pages.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $servis = Servis::with('kendaraan')->where('status_servis', '!=', 'selesai')->get();
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
            'pajak' => 'nullable|numeric|min:1',
            'diskon' => 'nullable|numeric|min:1',
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
            $transaksi->pajak = $request->pajak ?? 0;
            $transaksi->diskon = $request->diskon ?? 0;
            $transaksi->total_harga = 0;
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

                    $barang = Barang::findOrFail($item['barang_id']);
                    if ($barang->stok < $item['jumlah']) {
                        Alert::error('Stok Tidak Cukup', "Stok untuk barang {$barang->nama_barang} tidak mencukupi.");
                        return redirect()->back();
                    }
                    $barang->stok -= $item['jumlah'];
                    $barang->save();
                    $totalItems += $item['jumlah'] * $item['harga_satuan'];
                }
            }

            $subtotal = $servis->total_biaya + $totalItems;

            $diskonAmount = $subtotal * ($transaksi->diskon / 100);

            $subtotalAfterDiskon = $subtotal - $diskonAmount;

            $pajakAmount = $subtotalAfterDiskon * ($transaksi->pajak / 100);

            $transaksi->total_harga = $subtotalAfterDiskon + $pajakAmount;
            $transaksi->save();

            $servis->status_servis = 'selesai';
            $servis->tgl_keluar = Carbon::now();
            $servis->save();

            DB::commit();
            Alert::success("Transaksi berhasil dibuat");
            return redirect()->route('transaksi.index');
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
        $transaksi = Transaksi::with(['servis.kendaraan.pelanggan', 'user', 'items.barang','servis.jasaServis'])->findOrFail($id);
        return view('pages.transaksi.detail', compact('transaksi'));
    }

    public function destroy($id)
    {
        $user = Transaksi::findOrFail($id);

        $user->delete();

        Alert::success("Transaksi berhasil dihapus");
        return redirect()->route('transaksi.index');
    }

}

