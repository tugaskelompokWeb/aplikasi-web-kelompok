@extends('layouts.components.app')

@section('page-title', 'Form Pelanggan')
@section('breadcrumb', 'form-pelanggan')
@section('title', 'Pelanggan')
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
            {{-- form tambah Pelanggan --}}
            <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Form Tambah Pelanggan</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{ route('pelanggan.store') }}" method="POST">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="name" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        @error('name')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" required>
                        @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                      </div>
                      <div class="mb-3">
                        <label for="no_telp" class="form-label">No Telp</label>
                        <input type="text" class="form-control" name="no_telp" value="{{ old('no_telp') }}" required>
                        @error('no_telp')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" required>
                         @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                      </div>
                      <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" name="jenis_kelamin" required>
                         @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
                      </div>
                      <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="text" class="form-control" name="tanggal_lahir" required>
                         @error('tanggal_lahir') <small class="text-danger">{{ $message }}</small> @enderror
                      </div>
                      </div>
                      
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Row-->
@endsection
