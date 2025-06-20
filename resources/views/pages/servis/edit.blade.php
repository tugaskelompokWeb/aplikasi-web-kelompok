@extends('layouts.components.app')

@section('page-title', 'Form Edit Servis')
@section('breadcrumb', 'form-edit-servis')
@section('title', 'Servis')

@section('content')
<!--begin::Row-->
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Form Edit Servis</div>
            </div>

            <form action="{{ route('servis.update', $servis->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="mb-3">
                        <label for="tgl_datang" class="form-label">Tanggal Datang</label>
                        <input type="date" name="tgl_datang" class="form-control" value="{{ old('tgl_datang', $servis->tgl_datang) }}" required>
                        @error('tgl_datang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keluhan_awal" class="form-label">Keluhan Awal</label>
                        <textarea name="keluhan_awal" class="form-control" required>{{ old('keluhan_awal', $servis->keluhan_awal) }}</textarea>
                        @error('keluhan_awal')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kendaraan_id" class="form-label">Kendaraan</label>
                        <select class="form-control" name="kendaraan_id" required>
                            <option value="">-- Pilih Kendaraan --</option>
                            @foreach ($kendaraan as $k)
                                <option value="{{ $k->id }}" {{ old('kendaraan_id', $servis->kendaraan_id) == $k->id ? 'selected' : '' }}>
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
                                <option value="{{ $m->id }}" {{ old('mekanik_id', $servis->mekanik_id) == $m->id ? 'selected' : '' }}>
                                    {{ $m->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('mekanik_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Input jasa --}}
                    <div id="jasa-container">
                        @foreach ($servis->jasaServis as $index => $jasa)
                            <div class="mb-3 jasa-item">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="form-label">Nama Jasa</label>
                                        <input type="text" class="form-control" name="jasa[{{ $index }}][nama_jasa]" value="{{ $jasa->nama_jasa }}" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label">Biaya</label>
                                        <input type="number" class="form-control" name="jasa[{{ $index }}][biaya]" value="{{ $jasa->biaya }}" required>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger remove-jasa" style="margin-bottom: 16px;">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <button type="button" id="add-jasa" class="btn btn-secondary">Tambah Jasa</button>
                    </div>

                    <div class="mb-3">
                        <label for="status_servis" class="form-label">Status Servis</label>
                        <input type="text" name="status_servis" class="form-control" value="{{ old('status_servis', $servis->status_servis) }}">
                    </div>

                    <div class="mb-3">
                        <label for="tgl_keluar" class="form-label">Tanggal Keluar</label>
                        <input type="date" name="tgl_keluar" class="form-control" value="{{ old('tgl_keluar', $servis->tgl_keluar) }}">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('servis.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!--end::Row-->
@endsection
