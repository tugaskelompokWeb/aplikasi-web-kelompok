@extends('layouts.components.app')

@section('page-title', 'Form Edit User')
@section('breadcrumb', 'form-edit-user')
@section('title', 'User')

@section('content')
<!--begin::Row-->
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">Form Edit User</div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama User</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $users->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" value="{{ old('email', $users->email) }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select class="form-control" name="role_id" required>
                            <option value="">-- Pilih Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ (old('role_id', $users->role_id) == $role->id) ? 'selected' : '' }}>
                                    {{ $role->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No Telp</label>
                        <input type="text" class="form-control" name="no_telp" value="{{ old('no_telp', $users->no_telp) }}" required>
                        @error('no_telp') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="posisi" class="form-label">Posisi</label>
                        <input type="text" class="form-control" name="posisi" value="{{ old('posisi', $users->posisi) }}" required>
                        @error('posisi') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" required>{{ old('alamat', $users->alamat) }}</textarea>
                        @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    @if(isset($users) && $users->foto)
                    <div class="mb-3">
                        <label>Foto Saat Ini:</label><br>
                        <img src="{{ asset('storage/' . $users->foto) }}" alt="Foto User" width="120" class="img-thumbnail mb-2">
                    </div>
                @endif

                <div class="mb-3">
                    <label for="foto" class="form-label">Ganti Foto</label>
                    <input type="file" class="form-control" name="foto" accept="image/*">
                    @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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
