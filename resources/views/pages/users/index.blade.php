@extends('layouts.components.app')

@section('title', 'Users')

@section('page-title', 'Halaman User')
@section('breadcrumb', 'user')

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Tabel User</h3>
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
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah</a>

                    <form action="{{ route('users.index') }}" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" placeholder="Cari User" class="form-control" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
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
                        @foreach ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($item->foto)
                                    <img src="{{ $item->foto }}" alt="Foto" style="width: 60px; height: 80px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <img src="{{asset('dist/assets/img/avatar5.png')}}" alt="" style="width: 60px; height: 80px; object-fit: cover; border-radius: 4px;">
                                @endif
                            </td>
                            <td>{{ $item->name ?? null }}</td>
                            <td>{{ $item->role->nama }}</td>
                            <td>{{ $item->posisi }}</td>
                            <td>{{ $item->no_telp }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                <a href="{{ route('users.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('users.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
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
