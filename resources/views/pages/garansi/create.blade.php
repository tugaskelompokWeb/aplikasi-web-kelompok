@extends('layouts.components.app')

@section('page-title', 'Form Garansi')
@section('breadcrumb', 'form-garansi')
@section('title', 'Garansi')
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
            {{-- form tambah Garansi --}}
            <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Form Tambah Garansi</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{ route('garansi.store') }}" method="POST">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                      <!-- Select Pelanggan -->
                    <div class="mb-3">
                        <label for="pelanggan_id" class="form-label">Pelanggan</label>
                        <select class="form-control" name="pelanggan_id" id="pelanggan_id" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Select Kendaraan -->
                    <div class="mb-3">
                        <label for="kendaraan_id" class="form-label">Kendaraan</label>
                        <select class="form-control" name="kendaraan_id" id="kendaraan_id" required>
                            <option value="">-- Pilih Kendaraan --</option>
                            <!-- Akan diisi lewat JavaScript -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <input type="text" class="form-control" name="keluhan" value="{{ old('keluhan')}}" required>
                        @error('keluhan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_garansi" class="form-label">Tanggal_Garansi</label>
                        <input type="date" class="form-control" name="tanggal_garansi" value="{{ old('tanggal_garansi')}}" required>
                        @error('tanggal_garansi')
                            <div class="date-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="batas_akhir" class="form-label">Batas_Akhir</label>
                        <input type="date" class="form-control" name="batas_akhir" value="{{ old('batas_akhir') }}" required>
                        @error('batas_akhir')
                            <div class="date-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">Status</label>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="aktif" value="aktif" {{ old('status') == 'aktif' ? 'checked' : '' }} required>
                          <label class="form-check-label" for="aktif">Aktif</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="kadaluarsa" value="nonaktif" {{ old('status') == 'kadaluarsa' ? 'checked' : '' }}>
                          <label class="form-check-label" for="kadaluarsa">Kadaluarsa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="kadaluarsa" value="batal" {{ old('status') == 'batal' ? 'checked' : '' }}>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pelanggan_id').on('change', function() {
                var pelangganId = $(this).val();

                // Kosongkan dulu select kendaraan
                $('#kendaraan_id').html('<option value="">-- Pilih Kendaraan --</option>');

                if (pelangganId) {
                    $.ajax({
                        url: '/get-kendaraan/' + pelangganId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(index, kendaraan) {
                                $('#kendaraan_id').append('<option value="' + kendaraan.id + '">' + kendaraan.no_plat + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>


@endsection
