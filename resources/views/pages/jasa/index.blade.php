@extends('layouts.components.app')

@section('title', 'Jasa')

@section('page-title', 'Halaman Jasa')
@section('breadcrumb', 'jasa')

@section('content')
    <!-- begin::Row -->
     <div class="row">
        <div class="col-12">
            <!-- Default box -->
             <div class="card">
                <div class="card-header">
                    <h3 class="card-tittle">Tabel Jasa</h3>
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
                <div class="card-body">

                    {{-- // mulai untuk menampilkan pencarian --}}
                <div class="row mb-3 align-items-center">
                    <div class="col-md-6 col-sm-12 mb-2 mb-md-0">
                        <a href="{{ route('jasa.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <form action="{{ route('jasa.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama..." value="{{ request('search') }}">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- // selesai untuk menampilkan pencarian --}}

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Jasa</th>
                                <th>Biaya</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jasa as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_jasa ?? null }}</td>
                                <td>{{ $item->biaya }}</td>
                                <td>
                                    <a href="{{ route('jasa.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('jasa.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                    {!! $jasa->links('pagination::bootstrap-5') !!}
                </div>
                {{-- selesai untuk menampilkan pagination --}}

                </div>
                <!-- /card body -->
                <!-- /card footer -->
             </div>
             <!-- /card -->
        </div>
     </div>
     <!-- end::Row -->
      @endsection
