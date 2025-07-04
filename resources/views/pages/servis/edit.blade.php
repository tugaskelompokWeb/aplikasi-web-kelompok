@extends('layouts.components.app')

@section('page-title', 'Edit Servis')
@section('breadcrumb', 'edit-servis')
@section('title', 'Edit Servis')

@section('content')
<!--begin::Row-->
<div class="row">
    <div class="col-12">
        {{-- form edit Servis --}}
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">Form Edit Servis</div>
            </div>
            <!--end::Header-->

            <!--begin::Form-->
            <form action="{{ route('servis.update', $servis->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="mb-3">
                        <label for="tgl_datang" class="form-label">Tanggal Datang</label>
                        <input type="date" class="form-control" name="tgl_datang" value="{{ old('tgl_datang', $servis->tgl_datang) }}" required>
                        @error('tgl_datang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keluhan_awal" class="form-label">Keluhan Awal</label>
                        <textarea class="form-control" name="keluhan_awal" required>{{ old('keluhan_awal', $servis->keluhan_awal) }}</textarea>
                        @error('keluhan_awal')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kendaraan_id" class="form-label">Kendaraan</label>
                        <select class="form-control select2" name="kendaraan_id" required>
                            <option value="">-- Pilih Kendaraan --</option>
                            @foreach ($kendaraan as $k)
                                <option value="{{ $k->id }}" {{ (old('kendaraan_id', $servis->kendaraan_id) == $k->id) ? 'selected' : '' }}>
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
                        <select class="form-control select2" name="mekanik_id" required>
                            <option value="">-- Pilih Mekanik --</option>
                            @foreach ($mekanik as $m)
                                <option value="{{ $m->id }}" {{ (old('mekanik_id', $servis->mekanik_id) == $m->id) ? 'selected' : '' }}>
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
                                      {{ in_array($item->id, $selectedJasaIds ?? []) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="jasa{{ $item->id }}">
                                      {{ $item->nama_jasa }} - Rp{{ number_format($item->biaya) }}
                                    </label>
                                  </div>
                                </div>
                              @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Body-->

                <!--begin::Footer-->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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

    <!-- Select2 JS -->
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
