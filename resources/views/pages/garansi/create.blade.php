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
                        <label for="name" class="form-label">Nama Garansi</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                        @error('name')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" required>
                        @error('npm')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="password" class="form-label">Masukan Password</label>
                        <input type="text" class="form-control" name="password" value="{{ old('password') }}" required>
                        @error('password')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="text" class="form-control" name="password_confirmation" required>
                      </div>
                      <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select class="form-control" name="role_id" required>
                            <option value="">-- Pilih Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id') <small class="text-danger">{{ $message }}</small> @enderror
                      </div>
                      <div class="mb-3">
                        <label for="no_telp" class="form-label">No Telp</label>
                        <input type="text" class="form-control" name="no_telp" value="{{ old('no_telp') }}" required>
                        @error('no_telp') <small class="text-danger">{{ $message }}</small> @enderror
                      </div>
                      <div class="mb-3">
                        <label for="posisi" class="form-label">Posisi</label>
                        <input type="text" class="form-control" name="posisi" value="{{ old('posisi') }}" required>
                        @error('posisi') <small class="text-danger">{{ $message }}</small> @enderror
                      </div>
                      <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" required>{{ old('alamat') }}</textarea>
                        @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
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
