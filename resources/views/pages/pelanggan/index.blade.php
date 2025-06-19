@extends('layouts.components.app')

@section('title', 'Pelanggan')

@section('page-title', 'Halaman Pelanggan')
@section('breadcrumb', 'pelanggan')

@section('content')
    <!-- begin::Row -->
     <div class="row">
        <div class="col-12">
            <!-- Default box -->
             <div class="card">
                <div class="card-header">
                    <h3 class="card-tittle">Tabel Pelanggan</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                    
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-md-6 col-sm-12 mb-2 mb-md-0">
                        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <form action="{{ route('pelanggan.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama pelanggan..." value="{{ request('search') }}">
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
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No Telp</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelanggans as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama ?? null }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->telepon }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->tanggal_lahir }}</td>
                                <td>
                                    <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            
                <div class="d-flex justify-content-end mt-3">
                    {!! $pelanggans->links('pagination::bootstrap-5') !!}
                </div>
                <!-- /card body -->
                <!-- /card footer -->
             </div>
             <!-- /card -->
        </div>
     </div>
     <!-- end::Row -->
      @endsection
