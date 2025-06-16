<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kendaraan;
use App\Models\Mekanik;
use App\Models\Pelanggan;
use App\Models\Servis;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
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

        $filterKendaraan = $request->input('filter_kendaraan','bulanan');
        $filterBarang = $request->input('filter_barang','bulanan');

        if ($filterKendaraan == 'harian'){
        $jumlahPlat = DB::select('
            SELECT merek, COUNT(*) as jumlah
            FROM kendaraan
            WHERE DATE(created_at) = CURDATE()
            GROUP BY merek
        ');
        }else {
            $jumlahPlat = DB::select('
            SELECT merek, COUNT(*) as jumlah
            FROM kendaraan
            WHERE MONTH(created_at) = MONTH(CURDATE())
            GROUP BY merek
        ');
        }

        if ($filterBarang == 'harian'){
        $jumlahBarang = DB::select('
        SELECT kategori, COUNT(*) as jumlahBarang
        FROM barang
        WHERE DATE(created_at) = CURDATE()
        GROUP BY kategori');
        }else {
            $jumlahBarang = DB::select('
            SELECT kategori, COUNT(*) as jumlahBarang
            FROM barang
            WHERE MONTH(created_at) = MONTH(CURDATE())
            GROUP BY kategori');
        }


        return view('pages.dashboard.index', compact('totalServis', 'totalBarang', 'totalTransaksi',
        'totalPelanggan', 'totalKendaraan', 'totalMekanik', 'servisHariIni', 'pendapatanHariIni',
        'pendapatanBulanIni', 'stokMenipis', 'barangStokRendah','jumlahPlat', 'jumlahBarang', 'filterKendaraan', 'filterBarang'));
    }

}

