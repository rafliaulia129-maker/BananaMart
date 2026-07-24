<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Transaction::with('user')
            ->latest()
            ->get()
            ->map(function ($transaction) {
                return [
                    $transaction->transaction_number,
                    optional($transaction->user)->name,
                    $transaction->product_name,
                    $transaction->quantity,
                    $transaction->price,
                    $transaction->total_price,
                    $transaction->status,
                    $transaction->payment_method,
                    $transaction->payment_status,
                    optional($transaction->created_at)->format('Y-m-d H:i:s'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'No Transaksi',
            'Nama User',
            'Produk',
            'Qty',
            'Harga',
            'Total',
            'Status',
            'Metode Pembayaran',
            'Status Pembayaran',
            'Tanggal',
        ];
    }
}