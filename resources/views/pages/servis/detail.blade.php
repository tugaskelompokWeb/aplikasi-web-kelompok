@extends('layouts.components.app')

@section('title', 'Servis')

@section('page-title', 'Halaman Detail Servis')
@section('breadcrumb', 'servis')

@section('content')
<style>
    .detail-header {
        background-color: #6c757d;
        color: white;
    }
    .info-label {
        font-weight: 600;
        color: #6c757d;
    }
    .info-value {
        color: #343a40;
    }
    .status-badge {
        padding: 0.35em 0.65em;
        font-size: 0.875em;
        font-weight: 700;
        border-radius: 0.25rem;
    }
    .jasa-list {
        list-style-type: none;
        padding-left: 0;
    }
    .jasa-item {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0.5rem;
        background-color: rgba(0,0,0,0.03);
        border: 1px solid rgba(0,0,0,0.125);
        border-radius: 0.25rem;
        display: flex;
        justify-content: space-between;
    }
    .section-title {
        color: #6c757d;
        font-weight: 600;
        margin-top: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #dee2e6;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card card-outline card-secondary">
            {{-- <div class="card-header detail-header">
                <h3 class="card-title">Detail Servis</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div> --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="info-label">Tanggal Datang</label>
                            <p class="info-value">{{ $servis->tgl_datang }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="info-label">Tanggal Keluar</label>
                            <p class="info-value">{{ $servis->tgl_keluar ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="info-label">Status Servis</label>
                            <p>
                                @php
                                    $statusClass = [
                                        'pending' => 'badge-warning',
                                        'proses' => 'badge-info',
                                        'selesai' => 'badge-success',
                                        'batal' => 'badge-danger'
                                    ][$servis->status_servis] ?? 'badge-secondary';
                                @endphp
                                <span class="badge {{ $statusClass }} status-badge">
                                    {{ ucfirst($servis->status_servis) }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="info-label">Total Biaya</label>
                            <p class="info-value text-success font-weight-bold">
                                Rp {{ number_format($servis->total_biaya, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="info-label">Kendaraan</label>
                            <p class="info-value">{{ $servis->kendaraan->no_plat ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="info-label">Mekanik</label>
                            <p class="info-value">{{ $servis->mekanik->nama ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="info-label">Keluhan Awal</label>
                    <p class="info-value">{{ $servis->keluhan_awal }}</p>
                </div>

                <h5 class="section-title">Jasa Servis</h5>
                <ul class="jasa-list">
                    @forelse ($servis->jasaServis as $jasa)
                        <li class="jasa-item">
                            <span>{{ $jasa->nama_jasa }}</span>
                            <span>Rp {{ number_format($jasa->biaya, 0, ',', '.') }}</span>
                        </li>
                    @empty
                        <li class="text-muted">Tidak ada jasa servis</li>
                    @endforelse
                </ul>

                <div class="mt-4">
                    <a href="{{ route('servis.index') }}" class="btn btn-default">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Servis
                    </a>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection
