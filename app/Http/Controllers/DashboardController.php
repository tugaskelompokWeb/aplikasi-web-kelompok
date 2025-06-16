<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kendaraan;
use App\Models\Mekanik;
use App\Models\Pelanggan;
use App\Models\Servis;
use App\Models\Transaksi;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $totalServis = Servis::count();
        $totalBarang = Barang::count();
        $totalTransaksi = Transaksi::count();
        $totalPelanggan = Pelanggan::count();
        $totalKendaraan = Kendaraan::count();
        $totalMekanik = Mekanik::where('status', 'aktif')->count();
        $servisHariIni = Servis::whereDate('tgl_datang', Carbon::today())->count();
        $pendapatanHariIni = Transaksi::whereDate('created_at', Carbon::today())->sum('total_harga');
        $pendapatanBulanIni = Transaksi::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_harga');
        $stokMenipis = Barang::where('stok', '<=', 5)->count();
        $barangStokRendah = Barang::where('stok', '<=', 5)
            ->select('nama', 'stok', 'satuan')
            ->orderBy('stok', 'asc')
            ->limit(5)
            ->get();



         $jumlahPlat = DB::select('
            SELECT merek, COUNT(*) as jumlah
            FROM kendaraan
            GROUP BY merek
        ');

        $jumlahBarang = DB::select('
        SELECT kategori, COUNT(*) as jumlahBarang
        FROM barang
        GROUP BY kategori');


        return view('pages.dashboard.index', compact('totalServis', 'totalBarang', 'totalTransaksi',
        'totalPelanggan', 'totalKendaraan', 'totalMekanik', 'servisHariIni', 'pendapatanHariIni',
        'pendapatanBulanIni', 'stokMenipis', 'barangStokRendah','jumlahPlat', 'jumlahBarang'));
    }

}

