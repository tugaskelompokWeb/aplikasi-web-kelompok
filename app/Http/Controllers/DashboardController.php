<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Servis;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
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

        $monthlyData = Transaksi::with('items.barang')
        ->selectRaw('YEAR(tanggal) as year, MONTH(tanggal) as month, SUM(total_harga) as revenue')
        ->whereYear('tanggal', date('Y'))
        ->groupByRaw('YEAR(tanggal), MONTH(tanggal)')
        ->orderByRaw('YEAR(tanggal), MONTH(tanggal)')
        ->get();

        $monthlyRevenue = [];
        $monthlyProfit = [];
        $monthlyCategories = [];

        foreach ($monthlyData as $monthData) {
            $transaksis = Transaksi::with('items.barang')
                ->whereYear('tanggal', $monthData->year)
                ->whereMonth('tanggal', $monthData->month)
                ->get();

        $hpp = 0;
        foreach ($transaksis as $transaksi) {
            foreach ($transaksi->items as $item) {
                $hpp += ($item->barang->harga ?? 0) * $item->jumlah;
            }
        }

        $monthlyRevenue[] = $monthData->revenue;
        $monthlyProfit[] = $monthData->revenue - $hpp;
        $monthlyCategories[] = date('Y-m-01', strtotime($monthData->year . '-' . $monthData->month . '-01'));
        }

        $dailyData = Transaksi::with('items.barang')
            ->whereDate('tanggal', '>=', Carbon::now()->subDays(6))
            ->orderBy('tanggal')
            ->get()
            ->groupBy(fn($item) => $item->tanggal->format('Y-m-d'));

        $dailyRevenue = [];
        $dailyProfit = [];
        $dailyCategories = [];

        foreach (range(6, 0) as $i) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $transactions = $dailyData[$date] ?? collect();
            $revenue = $transactions->sum('total_harga');

            $hpp = 0;
            foreach ($transactions as $transaksi) {
                foreach ($transaksi->items as $item) {
                    $hpp += ($item->barang->harga ?? 0) * $item->jumlah;
                }
            }

            $dailyRevenue[] = $revenue;
            $dailyProfit[] = $revenue - $hpp;
            $dailyCategories[] = Carbon::parse($date)->translatedFormat('l');
        }

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $weeklyData = Transaksi::with('items.barang')
            ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->get()
            ->groupBy(fn($item) => 'Minggu ' . $item->tanggal->weekOfMonth);

        $weeklyRevenue = [];
        $weeklyProfit = [];
        $weeklyCategories = [];

        foreach ($weeklyData as $week => $transactions) {
            $revenue = $transactions->sum('total_harga');

            $hpp = 0;
            foreach ($transactions as $transaksi) {
                foreach ($transaksi->items as $item) {
                    $hpp += ($item->barang->harga ?? 0) * $item->jumlah;
                }
            }

            $weeklyRevenue[] = $revenue;
            $weeklyProfit[] = $revenue - $hpp;
            $weeklyCategories[] = $week;
        }

        $topBarang = TransaksiItem::select('barang_id', DB::raw('SUM(jumlah) as totalTerjual'))
                    ->groupBy('barang_id')
                    ->orderByDesc('totalTerjual')
                    ->with('barang:id,nama')
                    ->limit(5)
                    ->get();

        $topBarangLabels = $topBarang->pluck('barang.nama')->toArray();
        $topBarangData = $topBarang->pluck('totalTerjual')->map(fn($value) => (int) $value)->toArray();


        return view('pages.dashboard.index', compact('totalServis', 'totalBarang', 'totalTransaksi',
        'totalPelanggan', 'jumlahPlat', 'jumlahBarang', 'filterKendaraan',
        'filterBarang','monthlyRevenue', 'monthlyProfit', 'monthlyCategories',
        'dailyRevenue', 'dailyProfit', 'dailyCategories',
        'weeklyRevenue', 'weeklyProfit', 'weeklyCategories','topBarangLabels','topBarangData'));
    }

}

