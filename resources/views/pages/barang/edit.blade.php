@extends('layouts.components.app')

@section('page-title', 'Form Edit Garansi')
@section('breadcrumb', 'form-edit-garansi')
@section('title', 'Garansi')

@section('content')
<!--begin::Row-->
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">Form Edit Garansi</div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" required>
                        @error('kode_barang') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" name="nama" value="{{ old('nama', $barang->nama) }}" required>
                        @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-control" name="kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="oli" {{ old('kategori', $barang->kategori) == 'oli' ? 'selected' : '' }}>Oli</option>
                            <option value="sparepart" {{ old('kategori', $barang->kategori) == 'sparepart' ? 'selected' : '' }}>Sparepart</option>
                            <option value="aki" {{ old('kategori', $barang->kategori) == 'aki' ? 'selected' : '' }}>Aki</option>
                            <option value="lampu" {{ old('kategori', $barang->kategori) == 'lampu' ? 'selected' : '' }}>Lampu</option>
                        </select>
                        @error('kategori') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <select class="form-control" name="satuan" required>
                            <option value="">-- Pilih Satuan --</option>
                            <option value="pcs" {{ old('satuan', $barang->satuan) == 'pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="box" {{ old('satuan', $barang->satuan) == 'box' ? 'selected' : '' }}>Box</option>
                            <option value="kg" {{ old('satuan', $barang->satuan) == 'kg' ? 'selected' : '' }}>Kg</option>
                            <option value="liter" {{ old('satuan', $barang->satuan) == 'liter' ? 'selected' : '' }}>Liter</option>
                        </select>
                        @error('satuan') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" name="harga" value="{{ old('harga', $barang->harga) }}" min="0" required>
                        @error('harga') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok" value="{{ old('stok', $barang->stok) }}" min="0" required>
                        @error('stok') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>

            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Row-->
@endsection
