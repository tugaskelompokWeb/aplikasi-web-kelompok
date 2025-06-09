@extends('layouts.components.app')

@section('page-title', 'Form Edit Servis')
@section('breadcrumb', 'form-edit-servis')
@section('title', 'Servis')

@section('content')
<!--begin::Row-->
<div class="row">
    <div class="col-12">
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
                        <input type="date" name="tgl_datang" class="form-control" value="{{ $servis->tgl_datang }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="keluhan_awal" class="form-label">Keluhan Awal</label>
                        <textarea name="keluhan_awal" class="form-control" required>{{ $servis->keluhan_awal }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="status_servis" class="form-label">Status Servis</label>
                        <input type="text" name="status_servis" class="form-control" value="{{ $servis->status_servis }}">
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
@endsection
