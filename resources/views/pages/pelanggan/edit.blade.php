@extends('layouts.components.app')

@section('page-title', 'Form Pelanggan')
@section('breadcrumb', 'form-pelanggan')
@section('title', 'Pelanggan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Form Tambah Pelanggan</div>
            </div>

            <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" name="nama" value="{{ old('nama', $pelanggan->nama) }}" required>
                        @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $pelanggan->alamat) }}" required>
                        @error('alamat') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="telepon" class="form-label">No Telp</label>
                        <input type="text" class="form-control" name="telepon" value="{{ old('telepon', $pelanggan->telepon) }}" required>
                        @error('telepon') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $pelanggan->email) }}" required>
                        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                            <label class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin' , $pelanggan->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                            <label class="form-check-label">Perempuan</label>
                        </div>
                        @error('jenis_kelamin') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pelanggan->tanggal_lahir) }}" required>
                        @error('tanggal_lahir') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
