@extends('layouts.components.app')

@section('page-title', 'Form Transaksi')
@section('breadcrumb', 'form-transaksi')
@section('title', 'Transaksi')
@section('content')

<style>
        .card {
            border: none;
            border-radius: 12px;
        }

        .form-label {
            font-weight: 600;
            color: #343a40;
            font-size: 0.85rem;
            margin-bottom: 0.3rem;
        }

        .item-row {
            border: 1px solid #dee2e6;
            border-left: 4px solid #0d6efd;
            transition: 0.3s;
            padding: 0.8rem;
            margin-bottom: 0.8rem;
        }

        .item-row:hover {
            background-color: #f8f9fa;
        }

        .btn {
            border-radius: 6px;
            font-size: 0.8rem;
            padding: 0.35rem 0.75rem;
        }

        .form-select,
        .form-control {
            border-radius: 6px;
            font-size: 0.85rem;
            padding: 0.35rem 0.75rem;
            height: calc(1.8em + 0.75rem + 2px);
        }

        .summary-card {
            font-size: 0.9rem;
        }

        .summary-card h6 {
            font-size: 0.85rem;
            margin-bottom: 0.2rem;
        }

        .summary-card h5 {
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }

        .summary-card h3 {
            font-size: 1.2rem;
        }

        .item-title {
            font-size: 0.95rem;
        }

        .right-side-section {
            border-left: 1px dashed #dee2e6;
            padding-left: 20px;
        }

        .scrollable-items {
            max-height: 300px;
            overflow-y: auto;
            padding-right: 10px;
        }
</style>

<div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm p-3">
                <form action="{{ route('transaksi.store') }}" method="POST" id="transaksiForm">
                    @csrf
                    <div class="row">
                        <!-- Left Column (2/3 width) -->
                        <div class="col-md-8 pe-4">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="servis_id" class="form-label">
                                        <i class="fas fa-cogs me-1"></i>Servis <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select select2 @error('servis_id') is-invalid @enderror" id="servis_id"
                                        name="servis_id" required>
                                        <option value="">Pilih Servis</option>
                                        @foreach ($servis as $s)
                                            <option value="{{ $s->id }}" data-biaya="{{ $s->total_biaya }}"
                                                {{ old('servis_id') == $s->id ? 'selected' : '' }}>
                                                Servis #{{ $s->kendaraan->no_plat }} - {{ $s->keluhan_awal }} - Rp
                                                {{ number_format($s->total_biaya, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('servis_id')
                                        <div class="invalid-feedback" style="font-size: 0.75rem;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="mb-0 item-title"><i class="fas fa-shopping-cart me-2"></i>Item Transaksi</h5>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="addItem">
                                    <i class="fas fa-plus me-1"></i>Tambah
                                </button>
                            </div>

                            <div class="scrollable-items" id="itemContainer">
                                <div class="item-row">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-4">
                                            <label class="form-label">Barang <span class="text-danger">*</span></label>
                                            <select class="form-select barang-select select2" name="items[0][barang_id]">
                                                <option value="">Pilih Barang</option>
                                                @foreach ($barang as $b)
                                                    <option value="{{ $b->id }}" data-harga="{{ $b->harga }}">
                                                        {{ $b->nama }} - {{$b->stok}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control jumlah-input" name="items[0][jumlah]" min="1" value="1">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Harga Satuan</label>
                                            <input type="number" class="form-control harga-input" name="items[0][harga_satuan]" min="0" step="0.01" readonly>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Subtotal</label>
                                            <div class="d-flex align-items-center">
                                                <input type="text" class="form-control subtotal-display me-2" readonly>
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-item" disabled>
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4 right-side-section">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="metode_pembayaran" class="form-label">
                                        <i class="fas fa-credit-card me-1"></i>Metode Pembayaran <span
                                            class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('metode_pembayaran') is-invalid @enderror"
                                        id="metode_pembayaran" name="metode_pembayaran" required>
                                        <option value="">Pilih Metode Pembayaran</option>
                                        <option value="Cash" {{ old('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>
                                            Cash</option>
                                        <option value="Transfer Bank"
                                            {{ old('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>Transfer
                                            Bank</option>
                                        <option value="Kartu Kredit"
                                            {{ old('metode_pembayaran') == 'Kartu Kredit' ? 'selected' : '' }}>Kartu Kredit
                                        </option>
                                        <option value="E-Wallet"
                                            {{ old('metode_pembayaran') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet
                                        </option>
                                    </select>
                                    @error('metode_pembayaran')
                                        <div class="invalid-feedback" style="font-size: 0.75rem;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="diskon" class="form-label">
                                        <i class="fas fa-tag me-1"></i>Diskon (%) <span class="text-muted">(Opsional)</span>
                                    </label>
                                    <input type="number" class="form-control @error('diskon') is-invalid @enderror"
                                        id="diskon" name="diskon" min="0" max="100" step="0.01"
                                        value="{{ old('diskon') }}" placeholder="% diskon">
                                    @error('diskon')
                                        <div class="invalid-feedback" style="font-size: 0.75rem;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="pajak" class="form-label">
                                        <i class="fas fa-calculator me-1"></i>Pajak (%) <span
                                            class="text-muted">(Opsional)</span>
                                    </label>
                                    <input type="number" class="form-control @error('pajak') is-invalid @enderror"
                                        id="pajak" name="pajak" min="0" max="100" step="0.01"
                                        value="{{ old('pajak') }}" placeholder="% pajak">
                                    @error('pajak')
                                        <div class="invalid-feedback" style="font-size: 0.75rem;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card bg-light text-dark summary-card mt-4">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Subtotal</h6>
                                        <h6 class="mb-1" id="subtotalHarga">Rp 0</h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Diskon</h6>
                                        <h6 class="mb-1" id="diskonHarga">Rp 0</h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Pajak</h6>
                                        <h6 class="mb-1" id="pajakHarga">Rp 0</h6>
                                    </div>
                                    <hr class="my-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Total</h5>
                                        <h4 class="mb-0 text-primary" id="totalHarga">Rp 0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    let itemCount = 1;
    let servisBiaya = 0;

    const hargaBarang = {
        @foreach ($barang as $b)
            '{{ $b->id }}': {{ $b->harga }},
        @endforeach
    };

    const $addItemBtn = $('#addItem');
    const $itemContainer = $('#itemContainer');
    const $servisSelect = $('#servis_id');
    const $diskonInput = $('#diskon');
    const $pajakInput = $('#pajak');

    // Inisialisasi Select2 untuk elemen yang sudah ada
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "-- Pilih Data --",
            allowClear: true
        });
    });

    $servisSelect.on('change', function () {
        const selectedOption = $(this).find('option:selected');
        servisBiaya = parseFloat(selectedOption.data('biaya')) || 0;
        calculateTotal();
    });

    $addItemBtn.on('click', function () {
    const $firstItem = $('.item-row').first();

    // 1. Destroy select2 instance dulu sebelum clone
    $firstItem.find('.select2').select2('destroy');

    // 2. Clone elemen pertama
    const $newItem = $firstItem.clone();

    // 3. Kembalikan select2 di elemen pertama setelah clone
    $firstItem.find('.select2').select2({
        placeholder: "-- Pilih Data --",
        allowClear: true
    });

    // 4. Reset form field di clone
    $newItem.find('select, input').each(function () {
        const $el = $(this);
        if ($el.attr('name')) {
            $el.attr('name', $el.attr('name').replace('[0]', `[${itemCount}]`));
        }
        if ($el.attr('type') !== 'button') {
            $el.val($el.hasClass('jumlah-input') ? '1' : '');
        }
    });

    $newItem.find('.remove-item').prop('disabled', false);

    // 5. Append ke container
    $itemContainer.append($newItem);

    // 6. Inisialisasi Select2 di clone baru
    $newItem.find('.select2').select2({
        placeholder: "-- Pilih Data --",
        allowClear: true
    });

    itemCount++;
    updateRemoveButtons();
    calculateTotal();
});


    $(document).on('click', '.remove-item', function () {
        $(this).closest('.item-row').remove();
        updateRemoveButtons();
        calculateTotal();
    });

    $(document).on('change', '.barang-select', function () {
        const barangId = $(this).val();
        const harga = hargaBarang[barangId] || 0;
        const $row = $(this).closest('.item-row');
        $row.find('.harga-input').val(harga);
        calculateSubtotal($row);
    });

    $(document).on('input', '.jumlah-input, #diskon, #pajak', function () {
        const $row = $(this).closest('.item-row');
        if ($row.length) {
            calculateSubtotal($row);
        } else {
            calculateTotal();
        }
    });

    function updateRemoveButtons() {
        const $rows = $('.item-row');
        $rows.each(function () {
            const $btn = $(this).find('.remove-item');
            $btn.prop('disabled', $rows.length <= 1);
        });
    }

    function calculateSubtotal($row) {
        const jumlah = parseFloat($row.find('.jumlah-input').val()) || 0;
        const harga = parseFloat($row.find('.harga-input').val()) || 0;
        const subtotal = jumlah * harga;
        $row.find('.subtotal-display').val('Rp ' + subtotal.toLocaleString('id-ID'));
        calculateTotal();
    }

    function calculateTotal() {
        let itemsTotal = 0;

        $('.item-row').each(function () {
            const jumlah = parseFloat($(this).find('.jumlah-input').val()) || 0;
            const harga = parseFloat($(this).find('.harga-input').val()) || 0;
            itemsTotal += jumlah * harga;
        });

        const subtotal = servisBiaya + itemsTotal;
        const diskonPersen = parseFloat($diskonInput.val()) || 0;
        const pajakPersen = parseFloat($pajakInput.val()) || 0;
        const diskonAmount = subtotal * (diskonPersen / 100);
        const subtotalAfterDiskon = subtotal - diskonAmount;
        const pajakAmount = subtotalAfterDiskon * (pajakPersen / 100);
        const total = subtotalAfterDiskon + pajakAmount;

        $('#subtotalHarga').text('Rp ' + subtotal.toLocaleString('id-ID'));
        $('#diskonHarga').text('Rp ' + diskonAmount.toLocaleString('id-ID'));
        $('#pajakHarga').text('Rp ' + pajakAmount.toLocaleString('id-ID'));
        $('#totalHarga').text('Rp ' + total.toLocaleString('id-ID'));
    }

    // Hitung total awal jika sudah ada servis terpilih
    updateRemoveButtons();
    if ($servisSelect.val()) {
        const selectedOption = $servisSelect.find('option:selected');
        servisBiaya = parseFloat(selectedOption.data('biaya')) || 0;
        calculateTotal();
    }
</script>
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('error'))
<script>
  Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: '{{ session("error") }}',
    confirmButtonColor: '#d33',
  });
</script>
@endif




@endsection
