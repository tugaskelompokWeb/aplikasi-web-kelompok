@extends('layouts.components.app')

@section('page-title', 'Form Edit Pelanggan')
@section('breadcrumb', 'form-edit-pelanggan')
@section('title', 'Pelanggan')

@section('content')
<!--begin::Row-->
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">Form Edit Pelanggan</div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama pelanggan</label>
                        <input type="text" class="form-control" name="name" value="{{ old('pelanggan', $pelanggan->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="label" value="{{ old(' pelanggan', $pelanggan->alamat) }}" required>
                        @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        
                        @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                     <div class="mb-3">
                        <label for="no_telp" class="form-label">No Telp</label>
                        <input type="text" class="form-control" name="label" value="{{ old(' pelanggan', $pelanggan->no_telp) }}" required>
                        @error('no_telp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        
                        @error('no_telp') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="label" value="{{ old(' pelanggan', $pelanggan->email) }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" name="label" value="{{ old(' jenis_kelamin', $pelanggan->jenis_kelamin) }}" required>
                        @error('jenis_kelamin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        
                        @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                     <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>                        
                        <input type="text" class="form-control" name="label" value="{{ old(' pelanggan', $pelanggan->tanggal_lahir) }}" required>
                        @error('tanggal_lahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        
                        @error('tanggal_lahir') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    </div>
                <!--end::Body-->
                <!--begin::Foodiv class="mb-3">
                        <label for="posisi" class="form-label">Posisi</label>
                        <inpter-->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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


