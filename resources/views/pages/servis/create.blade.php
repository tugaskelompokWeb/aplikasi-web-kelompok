@extends('layouts.components.app')

@section('page-title', 'Form Servis')
@section('breadcrumb', 'form-servis')
@section('title', 'Servis')
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
            {{-- form tambah Servis --}}
            <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Form Tambah Servis</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{ route('servis.store') }}" method="POST">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="tgl_datang" class="form-label">Tanggal Datang</label>
                        <input type="date" class="form-control" name="tgl_datang" value="{{ old('tgl_datang') }}" required>
                        @error('tgl_datang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="mb-3">
                        <label for="keluhan_awal" class="form-label">Keluhan Awal</label>
                        <textarea class="form-control" name="keluhan_awal" required>{{ old('keluhan_awal') }}</textarea>
                        @error('keluhan_awal')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="mb-3">
                        <label for="kendaraan_id" class="form-label">Kendaraan</label>
                        <select class="form-control" name="kendaraan_id" required>
                            <option value="">-- Pilih Kendaraan --</option>
                            @foreach ($kendaraan as $k)
                                <option value="{{ $k->id }}" {{ (old('kendaraan_id') == $k->id) ? 'selected' : '' }}>
                                    {{ $k->no_plat }} - {{ $k->merk }}
                                </option>
                            @endforeach
                        </select>
                        @error('kendaraan_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div class="mb-3">
                        <label for="mekanik_id" class="form-label">Mekanik</label>
                        <select class="form-control" name="mekanik_id" required>
                            <option value="">-- Pilih Mekanik --</option>
                            @foreach ($mekanik as $m)
                                <option value="{{ $m->id }}" {{ (old('mekanik_id') == $m->id) ? 'selected' : '' }}>
                                    {{ $m->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('mekanik_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>

                      <div id="jasa-container">
                       <div class="mb-3">
                            <label class="form-label">Pilih Jasa</label>
                            <div class="row">
                                @foreach($jasa as $item)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input
                                                class="form-check-input jasa-checkbox"
                                                type="checkbox"
                                                name="jasa[]"
                                                value="{{ $item->id }}"
                                                id="jasa{{ $item->id }}"
                                                data-biaya="{{ $item->biaya }}"
                                            >
                                            <label class="form-check-label" for="jasa{{ $item->id }}">
                                                {{ $item->nama_jasa }} - Rp{{ number_format($item->biaya) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <h5>Total Biaya: <span id="totalBiayaDisplay">Rp0</span></h5>
                        </div>
                      </div>

                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="{{ route('servis.index') }}" class="btn btn-secondary">Kembali</a>
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
    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    }

    function hitungTotalBiaya() {
        let total = 0;

        $('.jasa-checkbox:checked').each(function() {
            let biaya = parseInt($(this).data('biaya'));
            if (!isNaN(biaya)) {
                total += biaya;
            }
        });

        $('#totalBiayaDisplay').text(formatRupiah(total));
    }

    $(document).ready(function () {
        $('.jasa-checkbox').on('change', function () {
            hitungTotalBiaya();
        });

        hitungTotalBiaya();
    });
</script>


@endsection
