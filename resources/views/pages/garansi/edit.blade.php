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
            <form action="{{ route('garansi.update', $garansi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="mb-3">
                      <label for="pelanggan_id" class="form-label">Pelanggan</label>
                      <select class="form-control" name="pelanggan_id" required>
                          <option value="">-- Pilih Pelanggan --</option>
                          @foreach ($pelanggans as $pelanggan)
                              <option value="{{ $pelanggan->id }}" {{ (old('pelanggan_id', $garansi->pelanggan_id) == $pelanggan->id) ? 'selected' : '' }}>
                                  {{ $pelanggan->nama }}
                              </option>
                          @endforeach
                      </select>
                      @error('pelanggan_id') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>
                  <div class="mb-3">
                      <label for="kendaraan_id" class="form-label">Kendaraan</label>
                      <select class="form-control" name="kendaraan_id" required>
                          <option value="">-- Pilih Kendaraan --</option>
                          @foreach ($kendaraans as $kendaraan)
                              <option value="{{ $kendaraan->id }}" {{ (old('kendaraan_id', $garansi->kendaraan_id) == $kendaraan->id) ? 'selected' : '' }}>
                                  {{ $kendaraan->no_plat }}
                              </option>
                          @endforeach
                      </select>
                      @error('kendaraan_id') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>
                  <div class="mb-3">
                      <label for="keluhan" class="form-label">Keluhan</label>
                      <input type="text" class="form-control" name="keluhan" value="{{ old('keluhan', $garansi->keluhan)}}" required>
                      @error('keluhan')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="tanggal_garansi" class="form-label">Tanggal_Garansi</label>
                      <input type="date" class="form-control" name="tanggal_garansi" value="{{ old('tanggal_garansi', $garansi->tanggal_garansi)}}" required>
                      @error('tanggal_garansi')
                          <div class="date-danger">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="batas_akhir" class="form-label">Batas_Akhir</label>
                      <input type="date" class="form-control" name="batas_akhir" value="{{ old('batas_akhir', $garansi->batas_akhir) }}" required>
                      @error('batas_akhir')
                          <div class="date-danger">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label class="form-label d-block">Status</label>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="aktif" value="aktif" {{ old('status', $garansi->status) == 'aktif' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="aktif">Aktif</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="kadaluarsa" value="kadaluarsa" {{ old('status', $garansi->status) == 'kadaluarsa' ? 'checked' : '' }}>
                        <label class="form-check-label" for="kadaluarsa">Kadaluarsa</label>
                      </div>
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="kadaluarsa" value="batal" {{ old('status', $garansi->status) == 'batal' ? 'checked' : '' }}>
                          <label class="form-check-label" for="batal">Batal</label>
                        </div>
                      @error('status')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
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
