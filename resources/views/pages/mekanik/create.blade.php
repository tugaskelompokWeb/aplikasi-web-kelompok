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
                        <label for="name" class="form-label">Nama Mekanik</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        @error('name')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="no_telp" class="form-label">No Telp</label>
                        <input type="text" class="form-control" name="no_telp" value="{{ old('no_telp') }}" required>
                        @error('no_telp') <small class="text-danger">{{ $message }}</small> @enderror
                      </div>
                      <div class="mb-3">
                        <label for="keahlian" class="form-label">Keahlian</label>
                        <input type="text" class="form-control" name="keahlian" value="{{ old('keahlian') }}" required>
                        @error('keahlian')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" name="status" required>
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
