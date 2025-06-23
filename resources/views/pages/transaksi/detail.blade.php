@extends('layouts.components.app')

@section('title', 'Detail Transaksi')

@section('page-title', 'Detail Transaksi')
@section('breadcrumb', 'transaksi-detail')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Detail Transaksi #{{ $transaksi->no_transaksi }}</h3>
                <div class="card-tools">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-default">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Tanggal Transaksi</span>
                                <span class="info-box-number text-center text-primary mb-0">
                                    {{ $transaksi->tanggal}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Pelanggan</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="30%">Nama</th>
                                        <td>{{ $transaksi->servis->kendaraan->pelanggan->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $transaksi->servis->kendaraan->pelanggan->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telepon</th>
                                        <td>{{ $transaksi->servis->kendaraan->pelanggan->telepon ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $transaksi->servis->kendaraan->pelanggan->alamat ?? '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Servis</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="30%">Jenis Servis</th>
                                        <td>
                                            @foreach ($transaksi->servis->jasaServis as $jasaServis)
                                              • {{ $jasaServis->jasa->nama_jasa ?? '-' }}<br>
                                            @endforeach
                                          </td>
                                          
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>{{ $transaksi->servis->keluhan_awal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Harga</th>
                                        <td> Rp {{ number_format($transaksi->servis->jasaServis->sum('biaya'), 0, ',', '.') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Barang yang Digunakan</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Barang</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transaksi->items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->barang->nama }}</td>
                                                <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                                <td>{{ $item->jumlah }}</td>
                                                <td>Rp {{ number_format($item->harga_satuan * $item->jumlah, 0, ',', '.') }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada barang digunakan</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Total Harga Servis:</th>
                                        <td class="text-right">Rp {{ number_format($transaksi->servis->total_biaya, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Harga Barang:</th>
                                        <td class="text-right">Rp {{ number_format($transaksi->items->sum(function($item) { return $item->harga_satuan * $item->jumlah; }), 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Keseluruhan:</th>
                                        <td class="text-right text-primary">
                                            <h4><b>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</b></h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <button class="btn btn-default mr-2">
                        <i class="fas fa-print mr-1"></i> Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
