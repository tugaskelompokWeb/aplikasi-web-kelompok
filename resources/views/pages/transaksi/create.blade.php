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
    }

    .item-row {
        border: 1px solid #dee2e6;
        border-left: 4px solid #0d6efd;
        transition: 0.3s;
    }

    .item-row:hover {
        background-color: #f8f9fa;
    }

    .btn {
        border-radius: 6px;
    }

    .form-select,
    .form-control {
        border-radius: 6px;
    }
</style>
    <!--begin::Row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm p-4">
                <form action="{{ route('transaksi.store') }}" method="POST" id="transaksiForm">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="servis_id" class="form-label">
                                <i class="fas fa-cogs me-1"></i>Servis <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('servis_id') is-invalid @enderror"
                                    id="servis_id" name="servis_id" required>
                                <option value="">Pilih Servis</option>
                                @foreach($servis as $s)
                                    <option value="{{ $s->id }}" data-biaya="{{ $s->total_biaya }}"
                                            {{ old('servis_id') == $s->id ? 'selected' : '' }}>
                                        Servis #{{ $s->id }} - {{ $s->keluhan_awal }} - Rp {{ number_format($s->total_biaya, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('servis_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="metode_pembayaran" class="form-label">
                                <i class="fas fa-credit-card me-1"></i>Metode Pembayaran <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('metode_pembayaran') is-invalid @enderror"
                                    id="metode_pembayaran" name="metode_pembayaran" required>
                                <option value="">Pilih Metode Pembayaran</option>
                                <option value="Cash" {{ old('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>Cash</option>
                                <option value="Transfer Bank" {{ old('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                                <option value="Kartu Kredit" {{ old('metode_pembayaran') == 'Kartu Kredit' ? 'selected' : '' }}>Kartu Kredit</option>
                                <option value="E-Wallet" {{ old('metode_pembayaran') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                            </select>
                            @error('metode_pembayaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Item Transaksi</h5>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="addItem">
                            <i class="fas fa-plus me-1"></i>Tambah Item
                        </button>
                    </div>
                    <div id="itemContainer">
                        <div class="item-row bg-white border rounded shadow-sm p-3 mb-3">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label">Barang <span class="text-danger">*</span></label>
                                    <select class="form-select barang-select" name="items[0][barang_id]">
                                        <option value="">Pilih Barang</option>
                                        @foreach($barang as $b)
                                            <option value="{{ $b->id }}" data-harga="{{ $b->harga }}">
                                                {{ $b->nama }} - Rp {{ number_format($b->harga, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control jumlah-input"
                                           name="items[0][jumlah]" min="1" value="1">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Harga Satuan <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control harga-input"
                                           name="items[0][harga_satuan]" min="0" step="0.01" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Subtotal</label>
                                    <input type="text" class="form-control subtotal-display" readonly>
                                </div>
                                <div class="col-md-1 text-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-item" disabled>
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end mb-4">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white text-center">
                                <div class="card-body">
                                    <h5 class="mb-1">Total Keseluruhan</h5>
                                    <h3 class="mb-0" id="totalHarga">Rp 0</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i>Simpan Transaksi
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
            @foreach($barang as $b)
            '{{ $b->id }}': {{ $b->harga }},
            @endforeach
        };

        const addItemBtn = document.getElementById('addItem');
        const itemContainer = document.getElementById('itemContainer');
        const servisSelect = document.getElementById('servis_id');

        servisSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            servisBiaya = parseFloat(selectedOption.getAttribute('data-biaya')) || 0;
            calculateTotal();
        });

        addItemBtn.addEventListener('click', function () {
            const newItem = document.querySelector('.item-row').cloneNode(true);

            newItem.querySelectorAll('select, input').forEach(function (el) {
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

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('.item-row').remove();
                updateRemoveButtons();
                calculateTotal();
            }
        });

        document.addEventListener('change', function (e) {
            if (e.target.classList.contains('barang-select')) {
                const barangId = e.target.value;
                const harga = hargaBarang[barangId] || 0;
                const row = e.target.closest('.item-row');
                row.querySelector('.harga-input').value = harga;
                calculateSubtotal(row);
            }
        });

        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('jumlah-input')) {
                const row = e.target.closest('.item-row');
                calculateSubtotal(row);
            }
        });

        function updateRemoveButtons() {
            const rows = document.querySelectorAll('.item-row');
            rows.forEach(function (row) {
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
            document.querySelectorAll('.item-row').forEach(function (row) {
                const jumlah = parseFloat(row.querySelector('.jumlah-input').value) || 0;
                const harga = parseFloat(row.querySelector('.harga-input').value) || 0;
                itemsTotal += jumlah * harga;
            });
            const total = servisBiaya + itemsTotal;
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
