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
                <a href="{{ route('servis.create') }}" class="btn btn-primary">Tambah</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Datang</th>
                            <th>Tanggal Keluar</th>
                            <th>Total Biaya</th>
                            <th>Keluhan Awal</th>
                            <th>Status Servis</th>
                            <th>Kendaraan</th>
                            <th>Mekanik</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servis as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tgl_datang ?? null }}</td>
                                <td>{{ $item->tgl_keluar ?? null }}</td>
                                <td>{{ $item->total_biaya ?? null }}</td>
                                <td>{{ $item->keluhan_awal ?? null }}</td>
                                <td>{{ $item->status_servis ?? null }}</td>
                                <td>{{ $item->kendaraan->no_plat ?? null }}</td>
                                <td>{{ $item->mekanik->nama ?? null }}</td>
                                <td>
                                    {{-- <a href="{{ route('garansi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                                    {{-- <form action="{{ route('garansi.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        </div>
    </div>
    <!--end::Row-->
@endsection
