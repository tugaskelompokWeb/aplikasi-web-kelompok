@extends('layouts.components.app')

@section('page-title', 'Form Mekanik')
@section('breadcrumb', 'form-mekanik')
@section('title', 'Mekanik')
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
            {{-- form tambah Mekanik --}}
            <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Form Tambah Mekanik</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{ route('mekanik.store') }}" method="POST">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="nama" class="form-label">Nama Mekanik</label>
                        <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="telepon" class="form-label">No Telp</label>
                        <input type="text" class="form-control" name="telepon" value="{{ old('telepon') }}" required>
                        @error('telepon') <small class="text-danger">{{ $message }}</small> @enderror
                      </div>
                      <div class="mb-3">
                        <label for="keahlian" class="form-label">Keahlian</label>
                        <input type="text" class="form-control" name="keahlian" value="{{ old('keahlian') }}" required>
                        @error('keahlian')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label class="form-label d-block">Status</label>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="aktif" value="aktif" {{ old('status') == 'aktif' ? 'checked' : '' }} required>
                          <label class="form-check-label" for="aktif">Aktif</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="tidak-aktif" value="nonaktif" {{ old('status') == 'nonaktif' ? 'checked' : '' }}>
                          <label class="form-check-label" for="tidak-aktif">Tidak Aktif</label>
                        </div>
                        @error('status')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>


                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="{{ route('mekanik.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Row-->
@endsection
