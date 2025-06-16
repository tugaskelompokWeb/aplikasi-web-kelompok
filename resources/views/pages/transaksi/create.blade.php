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
                                    <select class="form-select @error('servis_id') is-invalid @enderror" id="servis_id"
                                        name="servis_id" required>
                                        <option value="">Pilih Servis</option>
                                        @foreach ($servis as $s)
                                            <option value="{{ $s->id }}" data-biaya="{{ $s->total_biaya }}"
                                                {{ old('servis_id') == $s->id ? 'selected' : '' }}>
                                                Servis #{{ $s->id }} - {{ $s->keluhan_awal }} - Rp
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
                                        <div class="col-md-5">
                                            <label class="form-label">Barang <span class="text-danger">*</span></label>
                                            <select class="form-select barang-select" name="items[0][barang_id]">
                                                <option value="">Pilih Barang</option>
                                                @foreach ($barang as $b)
                                                    <option value="{{ $b->id }}" data-harga="{{ $b->harga }}">
                                                        {{ $b->nama }} - Rp {{ number_format($b->harga, 0, ',', '.') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control jumlah-input" name="items[0][jumlah]" min="1" value="1">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Harga Satuan</label>
                                            <input type="number" class="form-control harga-input" name="items[0][harga_satuan]" min="0" step="0.01" readonly>
                                        </div>
                                        <div class="col-md-2 d-flex flex-column">
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
                                        value="{{ old('diskon', 0) }}" placeholder="% diskon">
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
                                        value="{{ old('pajak', 0) }}" placeholder="% pajak">
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

<script>
        let itemCount = 1;
        let servisBiaya = 0;

        const hargaBarang = {
            @foreach ($barang as $b)
                '{{ $b->id }}': {{ $b->harga }},
            @endforeach
        };

        const addItemBtn = document.getElementById('addItem');
        const itemContainer = document.getElementById('itemContainer');
        const servisSelect = document.getElementById('servis_id');
        const diskonInput = document.getElementById('diskon');
        const pajakInput = document.getElementById('pajak');

        servisSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            servisBiaya = parseFloat(selectedOption.getAttribute('data-biaya')) || 0;
            calculateTotal();
        });

        addItemBtn.addEventListener('click', function() {
            const newItem = document.querySelector('.item-row').cloneNode(true);

            newItem.querySelectorAll('select, input').forEach(function(el) {
                if (el.name) {
                    el.name = el.name.replace('[0]', `[${itemCount}]`);
                }
                if (el.type !== 'button') {
                    el.value = el.classList.contains('jumlah-input') ? '1' : '';
                }
            });

            newItem.querySelector('.remove-item').disabled = false;
            itemContainer.appendChild(newItem);
            itemCount++;
            updateRemoveButtons();
            calculateTotal();
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('.item-row').remove();
                updateRemoveButtons();
                calculateTotal();
            }
        });

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('barang-select')) {
                const barangId = e.target.value;
                const harga = hargaBarang[barangId] || 0;
                const row = e.target.closest('.item-row');
                row.querySelector('.harga-input').value = harga;
                calculateSubtotal(row);
            }
        });

        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('jumlah-input') ||
                e.target.id === 'diskon' || e.target.id === 'pajak') {
                const row = e.target.closest('.item-row');
                if (row) {
                    calculateSubtotal(row);
                } else {
                    calculateTotal();
                }
            }
        });

        function updateRemoveButtons() {
            const rows = document.querySelectorAll('.item-row');
            rows.forEach(function(row) {
                const btn = row.querySelector('.remove-item');
                btn.disabled = rows.length <= 1;
            });
        }

        function calculateSubtotal(row) {
            const jumlah = parseFloat(row.querySelector('.jumlah-input').value) || 0;
            const harga = parseFloat(row.querySelector('.harga-input').value) || 0;
            const subtotal = jumlah * harga;
            row.querySelector('.subtotal-display').value = 'Rp ' + subtotal.toLocaleString('id-ID');
            calculateTotal();
        }

        function calculateTotal() {
            let itemsTotal = 0;
            document.querySelectorAll('.item-row').forEach(function(row) {
                const jumlah = parseFloat(row.querySelector('.jumlah-input').value) || 0;
                const harga = parseFloat(row.querySelector('.harga-input').value) || 0;
                itemsTotal += jumlah * harga;
            });

            // Hitung subtotal
            const subtotal = servisBiaya + itemsTotal;
            // Ambil nilai diskon dan pajak
            const diskonPersen = parseFloat(diskonInput.value) || 0;
            const pajakPersen = parseFloat(pajakInput.value) || 0;
            // Hitung jumlah diskon
            const diskonAmount = subtotal * (diskonPersen / 100);
            // Subtotal setelah diskon
            const subtotalAfterDiskon = subtotal - diskonAmount;
            // Hitung jumlah pajak
            const pajakAmount = subtotalAfterDiskon * (pajakPersen / 100);
            // Total akhir
            const total = subtotalAfterDiskon + pajakAmount;

            // Update tampilan
            document.getElementById('subtotalHarga').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
            document.getElementById('diskonHarga').textContent = 'Rp ' + diskonAmount.toLocaleString('id-ID');
            document.getElementById('pajakHarga').textContent = 'Rp ' + pajakAmount.toLocaleString('id-ID');
            document.getElementById('totalHarga').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        updateRemoveButtons();
        if (servisSelect.value) {
            const selectedOption = servisSelect.options[servisSelect.selectedIndex];
            servisBiaya = parseFloat(selectedOption.getAttribute('data-biaya')) || 0;
            calculateTotal();
        }
</script>

@endsection
