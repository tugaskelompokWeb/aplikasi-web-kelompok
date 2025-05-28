k7k\@extends('layouts.components.app')

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
                      <div class="mb-3">
                        <label for="id_pelanggan" class="form-label">id_pelanggan</label>
                        <select class="form-control" name="id_pelanggan" required>
                            <option value="">-- Pilih Id_Pelanggan --</option>
                            @foreach ($id_pelanggans as $id_pelanggan)
                                <option value="{{ $pelanggan->id }}" {{ (old('id_pelanggan', $users->id_pelanggan) == $pelanggan->id) ? 'selected' : '' }}>
                                    {{ $pelanggan->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_pelanggan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="id_kendaraan" class="form-label">id_kendaraan</label>
                        <select class="form-control" name="id_kendaraan" required>
                            <option value="">-- Pilih id_kendaraan --</option>
                            @foreach ($id_kendaraans as $id_kendaraan)
                                <option value="{{ $kendaraan->id }}" {{ (old('id_kendaraan', $users->id_kendaraan) == $kendaraan->id) ? 'selected' : '' }}>
                                    {{ $kendaraan->no_plat }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kendaraan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label">user_id</label>
                        <select class="form-control" name="user_id" required>
                            <option value="">-- Pilih user_id --</option>
                            @foreach ($user_ids as $user_id)
                                <option value="{{ $user->id }}" {{ (old('user_id', $users->user_id) == $user->id) ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <input type="text" class="form-control" name="keluhan" value="{{ old('keluhan', $garansi->keluhan) }}" required>
                        @error('keluhan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_garansi" class="form-label">Tanggal_Garansi</label>
                        <input type="date" class="form-control" name="tanggal_garansi" value="{{ old('tanggal_garansi', $garansi->tanggal_garansi) }}" required>
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
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" name="status" value="{{ old('status', $garansi->status) }}" required>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Row-->
@endsection
