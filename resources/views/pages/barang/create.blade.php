@extends('layouts.components.app')

@section('page-title', 'Form Barang')
@section('breadcrumb', 'form-barang')
@section('title', 'Barang')
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
            {{-- form tambah Garansi --}}
            <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Form Tambah Barang</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{ route('barang.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="kode_barang" class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" name="kode_barang" value="{{ old('kode_barang') }}" required>
                            @error('kode_barang') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
                            @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-control" name="kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="oli" {{ old('kategori') == 'oli' ? 'selected' : '' }}>Oli</option>
                                <option value="sparepart" {{ old('kategori') == 'sparepart' ? 'selected' : '' }}>Sparepart</option>
                                <option value="aki" {{ old('kategori') == 'aki' ? 'selected' : '' }}>Aki</option>
                                <option value="lampu" {{ old('kategori') == 'lampu' ? 'selected' : '' }}>Lampu</option>
                            </select>
                            @error('kategori') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan</label>
                            <select class="form-control" name="satuan" required>
                                <option value="">-- Pilih Satuan --</option>
                                <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>Pcs</option>
                                <option value="box" {{ old('satuan') == 'box' ? 'selected' : '' }}>Box</option>
                                <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kg</option>
                                <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>Liter</option>
                            </select>
                            @error('satuan') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" name="harga" value="{{ old('harga') }}" min="0" required>
                            @error('harga') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" name="stok" value="{{ old('stok') }}" min="0" required>
                            @error('stok') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>


                  <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Row-->
@endsection
