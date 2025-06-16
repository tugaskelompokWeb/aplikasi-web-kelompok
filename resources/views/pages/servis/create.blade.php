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
                        <div class="mb-3 jasa-item">
                          <div class="row">
                            <div class="col-md-5">
                              <label class="form-label">Nama Jasa</label>
                              <input type="text" class="form-control" name="jasa[0][nama_jasa]" required>
                            </div>
                            <div class="col-md-5">
                              <label class="form-label">Biaya</label>
                              <input type="number" class="form-control" name="jasa[0][biaya]" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                              <button type="button" class="btn btn-danger remove-jasa" style="margin-bottom: 16px;">Hapus</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="mb-3">
                        <button type="button" id="add-jasa" class="btn btn-secondary">Tambah Jasa</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let jasaIndex = document.querySelectorAll('.jasa-item').length;

            const addButton = document.getElementById('add-jasa');
            const jasaContainer = document.getElementById('jasa-container');

            addButton.addEventListener('click', function () {
                const newJasa = document.createElement('div');
                newJasa.classList.add('mb-3', 'jasa-item');
                newJasa.innerHTML = `
                    <div class="row">
                        <div class="col-md-5">
                            <label class="form-label">Nama Jasa</label>
                            <input type="text" class="form-control" name="jasa[${jasaIndex}][nama_jasa]" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Biaya</label>
                            <input type="number" class="form-control" name="jasa[${jasaIndex}][biaya]" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-jasa" style="margin-bottom: 16px;">Hapus</button>
                        </div>
                    </div>
                `;
                jasaContainer.appendChild(newJasa);
                jasaIndex++;
            });

            jasaContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-jasa')) {
                    const jasaItems = document.querySelectorAll('.jasa-item');
                    if (jasaItems.length > 1) {
                        e.target.closest('.jasa-item').remove();
                    } else {
                        alert('Minimal harus ada satu jasa');
                    }
                }
            });
        });
    </script>


@endsection
