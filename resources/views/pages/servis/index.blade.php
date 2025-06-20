@extends('layouts.components.app')

@section('title', 'Servis')

@section('page-title', 'Halaman Servis')
@section('breadcrumb', 'servis')

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Tabel Servis</h3>
            <div class="card-tools">
                <button
                type="button"
                class="btn btn-tool"
                data-lte-toggle="card-collapse"
                title="Collapse"
                >
                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                </button>
                <button
                type="button"
                class="btn btn-tool"
                data-lte-toggle="card-remove"
                title="Remove"
                >
                <i class="bi bi-x-lg"></i>
                </button>
            </div>
            </div>
            <div class="card-body">

                 {{-- // mulai untuk menampilkan pencarian --}}
                <div class="row mb-3 align-items-center">
                    <div class="col-md-6 col-sm-12 mb-2 mb-md-0">
                        <a href="{{ route('servis.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <form action="{{ route('servis.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari Nama Mekanik..." value="{{ request('search') }}">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Datang</th>
                            <th>Kendaraan</th>
                            <th>Mekanik</th>
                            <th>Status</th>
                            <th>Total Biaya</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servis as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tgl_datang ?? null }}</td>
                                <td>{{ $item->kendaraan->no_plat ?? null }}</td>
                                <td>{{ $item->mekanik->nama ?? null }}</td>
                                <td>{{ $item->status_servis ?? null }}</td>
                                <td>Rp{{ number_format($item->total_biaya, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('servis.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('servis.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('servis.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- mulai untuk menampilkan pagination --}}
                <div class="d-flex justify-content-end mt-3">
                    {!! $servis->links('pagination::bootstrap-5') !!}
                </div>
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        </div>
    </div>
    <!--end::Row-->
@endsection
