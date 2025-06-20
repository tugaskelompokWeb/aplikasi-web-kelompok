@extends('layouts.components.app')

@section('page-title', 'Form Edit Jasa')
@section('breadcrumb', 'form-edit-jasa')
@section('title', 'Jasa')

@section('content')
<!--begin::Row-->
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">Form Edit Jasa</div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="{{ route('jasa.update', $jasa->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!--begin::Body-->
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nama_jasa" class="form-label">Nama Jasa</label>
                        <input type="text" class="form-control" name="nama_jasa" value="{{ old('nama_jasa', $jasa->nama_jasa) }}">
                        @error('nama_jasa')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="biaya" class="form-label">Biaya</label>
                        <input type="text" class="form-control" name="biaya" value="{{ old('biaya', $jasa->biaya) }}">
                        @error('biaya')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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
