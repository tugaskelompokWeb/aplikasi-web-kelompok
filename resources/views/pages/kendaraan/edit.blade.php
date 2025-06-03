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
            <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="mb-3">
                      <label for="pelanggan_id" class="form-label">Pelanggan</label>
                      <select class="form-control" name="pelanggan_id" required>
                          <option value="">-- Pilih Pelanggan --</option>
                          @foreach ($pelanggans as $pelanggan)
                              <option value="{{ $pelanggan->id }}" {{ (old('pelanggan_id', $kendaraan->pelanggan_id) == $pelanggan->id) ? 'selected' : '' }}>
                                  {{ $pelanggan->nama }}
                              </option>
                          @endforeach
                      </select>
                      @error('pelanggan_id') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>
                  <div class="mb-3">
                      <label for="no_plat" class="form-label">No Plat</label>
                      <input type="text" class="form-control" name="no_plat" value="{{ old('no_plat', $kendaraan->no_plat)}}" required>
                      @error('no_plat')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="merek" class="form-label">Merek</label>
                      <input type="text" class="form-control" name="merek" value="{{ old('merek', $kendaraan->merek)}}" required>
                      @error('merek')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="tipe" class="form-label">Tipe</label>
                      <input type="text" class="form-control" name="tipe" value="{{ old('tipe', $kendaraan->tipe) }}" required>
                      @error('tipe')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="warna" class="form-label">Warna</label>
                      <input type="text" class="form-control" name="warna" value="{{ old('warna', $kendaraan->warna) }}" required>
                      @error('warna')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="tahun" class="form-label">Tahun</label>
                      <input type="text" class="form-control" name="tahun" value="{{ old('tahun', $kendaraan->tahun) }}" required>
                      @error('tahun')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
                  </div>

                  <!--end::Body-->
                  <!--begin::Footer-->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('garansi.index') }}" class="btn btn-secondary">Kembali</a>
                  </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Row-->
@endsection
