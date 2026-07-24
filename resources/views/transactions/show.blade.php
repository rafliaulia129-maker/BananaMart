@extends('layouts.app')

@section('content')
<style>
    .receipt-wrapper {
        max-width: 800px;
        margin: 0 auto;
        padding: 24px;
    }

    .receipt-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .receipt-header {
        padding: 24px;
        border-bottom: 1px solid #e5e7eb;
        text-align: center;
    }

    .receipt-body {
        padding: 24px;
    }

    .receipt-row {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        padding: 10px 0;
        border-bottom: 1px dashed #d1d5db;
    }

    .receipt-row:last-child {
        border-bottom: none;
    }

    .receipt-label {
        font-weight: 600;
        color: #374151;
    }

    .receipt-value {
        color: #111827;
        text-align: right;
    }

    .receipt-box {
        margin-top: 20px;
        padding: 16px;
        border-radius: 10px;
        background: #fff7ed;
        border: 1px solid #fdba74;
    }

    .receipt-actions {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }

    .btn-print,
    .btn-back {
        display: inline-block;
        width: 100%;
        text-align: center;
        padding: 14px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-print {
        background: #f59e0b;
        color: white;
        border: none;
    }

    .btn-back {
        background: white;
        color: #374151;
        border: 1px solid #d1d5db;
    }

    .proof-image,
    .qris-image {
        margin-top: 12px;
        width: 260px;
        max-width: 100%;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        background: white;
        padding: 8px;
    }

    @media print {
        @page {
            margin: 12mm;
        }

        body {
            background: #ffffff !important;
        }

        .print-hide,
        header,
        nav,
        aside,
        footer {
            display: none !important;
        }

        .receipt-wrapper {
            max-width: 100%;
            padding: 0;
        }

        .receipt-card {
            border: none;
            box-shadow: none;
        }

        .receipt-header {
            text-align: center;
        }

        .receipt-box {
            background: #ffffff !important;
            border: 1px solid #d1d5db !important;
        }
    }
</style>

<div class="receipt-wrapper">
    @if (session('success'))
        <div class="mb-4 rounded bg-green-100 p-4 text-green-800 print-hide">
            {{ session('success') }}
        </div>
    @endif

    <div class="receipt-card" id="print-area">
        <div class="receipt-header">
            <h1 style="font-size: 28px; font-weight: 800; margin-bottom: 8px;">Struk Pembayaran BananaMart</h1>
            <p style="color: #6b7280;">Terima kasih, pesanan Anda telah berhasil dibuat.</p>
        </div>

        <div class="receipt-body">
            <div class="receipt-row">
                <span class="receipt-label">No. Transaksi</span>
                <span class="receipt-value">{{ $transaction->transaction_number }}</span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Produk</span>
                <span class="receipt-value">{{ $transaction->product_name }}</span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Jumlah</span>
                <span class="receipt-value">{{ $transaction->quantity }}</span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Harga Satuan</span>
                <span class="receipt-value">Rp{{ number_format($transaction->price, 0, ',', '.') }}</span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Total Bayar</span>
                <span class="receipt-value"><strong>Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</strong></span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Metode Pembayaran</span>
                <span class="receipt-value">{{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}</span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Status Pembayaran</span>
                <span class="receipt-value">{{ ucfirst($transaction->payment_status) }}</span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Status Pesanan</span>
                <span class="receipt-value">{{ ucfirst($transaction->status) }}</span>
            </div>

            <div class="receipt-row">
                <span class="receipt-label">Tanggal</span>
                <span class="receipt-value">{{ $transaction->created_at->format('d-m-Y H:i') }}</span>
            </div>

            @if ($transaction->payment_method === 'transfer_bank')
                <div class="receipt-box">
                    <p style="font-weight: 700; margin-bottom: 8px;">Instruksi Transfer Bank</p>
                    <p>Bank BCA: 1234567890</p>
                    <p>a.n. BananaMart</p>
                </div>
            @endif

            @if ($transaction->payment_method === 'qris')
                <div class="receipt-box">
                    <p style="font-weight: 700; margin-bottom: 8px;">Instruksi Pembayaran QRIS</p>
                    <p>Silakan scan QRIS berikut jika belum membayar.</p>
                    <img
                        src="{{ asset('images/generated-image.jpg') }}"
                        alt="QRIS BananaMart"
                        class="qris-image"
                    >
                </div>
            @endif

            @if ($transaction->payment_proof)
                <div class="receipt-box">
                    <p style="font-weight: 700; margin-bottom: 8px;">Bukti Pembayaran</p>
                    <img
                        src="{{ asset('storage/' . $transaction->payment_proof) }}"
                        alt="Bukti Pembayaran"
                        class="proof-image"
                    >
                </div>
            @endif

            <div class="receipt-actions print-hide">
                <button type="button" onclick="window.print()" class="btn-print">
                    Cetak Struk
                </button>

                <a href="{{ route('transactions.index') }}" class="btn-back">
                    Riwayat Transaksi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection