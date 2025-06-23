@extends('layouts.components.app')

@section('page-title', 'Form Kendaraan')
@section('breadcrumb', 'form-kendaraan')
@section('title', 'Kendaraan')
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
            {{-- form tambah Kendaraan --}}
            <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Form Tambah Kendaraan</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{ route('kendaraan.store') }}" method="POST">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="pelanggan_id" class="form-label">Pelanggan</label>
                        <select class="form-control select2" name="pelanggan_id" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id }}" {{ (old('pelanggan_id') == $pelanggan->id) ? 'selected' : '' }}>
                                    {{ $pelanggan->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('pelanggan_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_plat" class="form-label">No Plat</label>
                        <input type="text" class="form-control" name="no_plat" value="{{ old('no_plat')}}" required>
                        @error('no_plat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="merek" class="form-label">Merek</label>
                        <input type="text" class="form-control" name="merek" value="{{ old('merek')}}" required>
                        @error('merek')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tipe" class="form-label">Tipe</label>
                        <input type="text" class="form-control" name="tipe" value="{{ old('tipe') }}" required>
                        @error('tipe')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="warna" class="form-label">Warna</label>
                        <input type="text" class="form-control" name="warna" value="{{ old('warna') }}" required>
                        @error('warna')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="text" class="form-control" name="tahun" value="{{ old('tahun') }}" required>
                        @error('tahun')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Row-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
        $('.select2').select2({
            placeholder: "-- Pilih Data --",
            allowClear: true
        });
        });
    </script>
@endsection
