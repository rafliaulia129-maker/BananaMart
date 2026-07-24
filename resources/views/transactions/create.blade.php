@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <div class="rounded-lg bg-white p-6 shadow">
        <h1 class="mb-5 text-2xl font-bold">Pembayaran Pesanan</h1>

        @if ($errors->any())
            <div class="mb-4 rounded bg-red-100 p-4 text-red-800">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-5 rounded border bg-gray-50 p-4">
            <p><strong>Produk:</strong> {{ $product->name }}</p>
            <p><strong>Harga Satuan:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
            <p><strong>Stok Tersedia:</strong> {{ $product->stock }}</p>
        </div>

        <form
            action="{{ route('transactions.store', $product) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="mb-4">
                <label for="quantity" class="mb-1 block font-medium">
                    Jumlah Produk
                </label>

                <input
                    id="quantity"
                    type="number"
                    name="quantity"
                    min="1"
                    max="{{ $product->stock }}"
                    value="{{ old('quantity', 1) }}"
                    class="w-full rounded border px-3 py-2"
                    required
                >

                <p class="mt-1 text-sm text-gray-500">
                    Maksimal pembelian: {{ $product->stock }} produk.
                </p>
            </div>

            <div class="mb-4 rounded border bg-gray-50 p-4">
                <p><strong>Estimasi Total:</strong> <span id="total-price">Rp{{ number_format($product->price, 0, ',', '.') }}</span></p>
            </div>

            <div class="mb-4">
                <label for="payment_method" class="mb-1 block font-medium">
                    Metode Pembayaran
                </label>

                <select
                    id="payment_method"
                    name="payment_method"
                    class="w-full rounded border px-3 py-2"
                    required
                >
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="transfer_bank" @selected(old('payment_method') === 'transfer_bank')>
                        Transfer Bank
                    </option>
                    <option value="qris" @selected(old('payment_method') === 'qris')>
                        QRIS
                    </option>
                    <option value="cod" @selected(old('payment_method') === 'cod')>
                        COD / Bayar di Tempat
                    </option>
                </select>
            </div>

            <div id="bank-info" class="mb-4 hidden rounded bg-yellow-50 p-4 text-yellow-900">
                <p class="font-semibold mb-2">Pembayaran Transfer Bank</p>
                <p>Bank BCA: 1234567890</p>
                <p>a.n. BananaMart</p>
            </div>

            <div id="qris-info" class="mb-4 hidden rounded bg-yellow-50 p-4 text-yellow-900">
                <p class="font-semibold mb-2">Pembayaran QRIS</p>
                <p class="mb-3">Silakan scan QRIS BananaMart di bawah ini, lalu unggah bukti pembayaran.</p>

                <div class="rounded bg-white p-4 shadow-sm border">
                    <img
                        src="{{ asset('images/qris-bananamart.png') }}"
                        alt="QRIS BananaMart"
                        class="mx-auto w-64 rounded"
                    >
                </div>
            </div>

            <div id="proof-section" class="mb-5 hidden">
                <label for="payment_proof" class="mb-1 block font-medium">
                    Bukti Pembayaran
                </label>

                <input
                    id="payment_proof"
                    type="file"
                    name="payment_proof"
                    accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                    class="w-full rounded border px-3 py-2"
                >

                <p class="mt-1 text-sm text-gray-500">
                    Format JPG, JPEG, atau PNG. Maksimal 2 MB. Jika validasi gagal, file harus diunggah ulang.
                </p>
            </div>

            <<input type="hidden" id="payment_status" name="payment_status" value="{{ old('payment_status', 'waiting') }}">

<div style="margin-top: 30px; border-top: 1px solid #e5e7eb; padding-top: 24px;">
    <button
        type="submit"
        style="display:block; width:100%; background:#f59e0b; color:white; border:none; padding:14px 20px; border-radius:10px; font-size:18px; font-weight:700; cursor:pointer;"
    >
        Bayar Sekarang
    </button>

    <a
        href="{{ route('products.show', $product) }}"
        style="display:block; width:100%; margin-top:12px; text-align:center; border:1px solid #d1d5db; padding:14px 20px; border-radius:10px; color:#374151; text-decoration:none; font-weight:600;"
    >
        Batal
    </a>
</div>
        </form>
    </div>
</div>

<script>
    const methodSelect = document.getElementById('payment_method');
    const bankInfo = document.getElementById('bank-info');
    const qrisInfo = document.getElementById('qris-info');
    const proofSection = document.getElementById('proof-section');
    const proofInput = document.getElementById('payment_proof');
    const quantityInput = document.getElementById('quantity');
    const totalPrice = document.getElementById('total-price');
    const paymentStatus = document.getElementById('payment_status');

    const productPrice = {{ (float) $product->price }};

    function formatRupiah(number) {
        return 'Rp' + new Intl.NumberFormat('id-ID').format(number);
    }

    function updatePaymentForm() {
        const method = methodSelect.value;
        const needsProof = method === 'transfer_bank' || method === 'qris';

        bankInfo.classList.toggle('hidden', method !== 'transfer_bank');
        qrisInfo.classList.toggle('hidden', method !== 'qris');
        proofSection.classList.toggle('hidden', !needsProof);

        proofInput.required = needsProof;
        paymentStatus.value = method === 'cod' ? 'unpaid' : 'waiting';

        if (!needsProof) {
            proofInput.value = '';
        }
    }

    function updateTotalPrice() {
        const quantity = parseInt(quantityInput.value || 1);
        totalPrice.textContent = formatRupiah(productPrice * quantity);
    }

    methodSelect.addEventListener('change', updatePaymentForm);
    quantityInput.addEventListener('input', updateTotalPrice);

    updatePaymentForm();
    updateTotalPrice();
</script>
@endsection