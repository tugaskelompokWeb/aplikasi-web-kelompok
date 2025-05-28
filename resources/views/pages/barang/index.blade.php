@extends('layouts.components.app')

@section('title', 'Garansi')

@section('page-title', 'Halaman Garansi')
@section('breadcrumb', 'garansi')

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Tabel Garansi</h3>
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
                <a href="{{ route('garansi.create') }}" class="btn btn-primary">Tambah</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Posisi</th>
                            <th>No Telp</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($garansi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name ?? null }}</td>
                            <td>{{ $item->role->nama }}</td>
                            <td>{{ $item->posisi }}</td>
                            <td>{{ $item->no_telp }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                <a href="{{ route('garansi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('garansi.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
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
