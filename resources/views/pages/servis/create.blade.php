@extends('layouts.components.app')

@section('page-title', 'Form Servis')
@section('breadcrumb', 'form-servis')
@section('title', 'Servis')
@section('content')
<style>
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    .jasa-item {
        background-color: #f8f9fa;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #dee2e6;
    }
    .section-title {
        color: #495057;
        font-weight: 600;
        margin: 20px 0 15px;
        padding-bottom: 8px;
        border-bottom: 1px solid #dee2e6;
    }
    .form-label {
        font-weight: 600;
        color: #495057;
    }
    .btn-add-jasa {
        margin-top: 5px;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Servis</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('servis.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_datang" class="form-label">Tanggal Datang</label>
                                <input type="date" name="tgl_datang" class="form-control @error('tgl_datang') is-invalid @enderror" required>
                                @error('tgl_datang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keluhan_awal" class="form-label">Keluhan Awal</label>
                        <textarea name="keluhan_awal" class="form-control @error('keluhan_awal') is-invalid @enderror" rows="3" required></textarea>
                        @error('keluhan_awal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kendaraan_id" class="form-label">Kendaraan</label>
                                <select name="kendaraan_id" class="form-control select2 @error('kendaraan_id') is-invalid @enderror" required>
                                    <option value="">Pilih Kendaraan</option>
                                    @foreach ($kendaraan as $item)
                                        <option value="{{ $item->id }}" {{ old('kendaraan_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->no_plat }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kendaraan_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mekanik_id" class="form-label">Mekanik</label>
                                <select name="mekanik_id" class="form-control select2 @error('mekanik_id') is-invalid @enderror" required>
                                    <option value="">Pilih Mekanik</option>
                                    @foreach ($mekanik as $item)
                                        <option value="{{ $item->id }}" {{ old('mekanik_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mekanik_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <h5 class="section-title">Jasa Servis</h5>
                    <div id="jasa-container">
                        <div class="jasa-item">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" name="jasa[0][nama_jasa]" class="form-control" placeholder="Nama Jasa" required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="number" name="jasa[0][biaya]" class="form-control" placeholder="Biaya" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-block remove-jasa">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary btn-add-jasa" id="add-jasa">
                        <i class="fas fa-plus"></i> Tambah Jasa
                    </button>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('servis.index') }}" class="btn btn-default">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        let jasaIndex = 1;
        $('#add-jasa').click(function() {
            const newItem = `
                <div class="jasa-item">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" name="jasa[${jasaIndex}][nama_jasa]" class="form-control" placeholder="Nama Jasa" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="number" name="jasa[${jasaIndex}][biaya]" class="form-control" placeholder="Biaya" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-block remove-jasa">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            $('#jasa-container').append(newItem);
            jasaIndex++;
        });

        $(document).on('click', '.remove-jasa', function() {
            if($('.jasa-item').length > 1) {
                $(this).closest('.jasa-item').remove();
            } else {
                toastr.warning('Minimal harus ada satu jasa servis');
            }
        });
    });
</script>
@endsection
