<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    public function exportExcel()
    {
        $transactions = Transaction::with('user')->latest()->get();

        $csv = "No Transaksi,User,Produk,Qty,Harga,Total,Status,Payment Method,Payment Status\n";

        foreach ($transactions as $transaction) {
            $csv .= implode(',', [
                '"' . $transaction->transaction_number . '"',
                '"' . optional($transaction->user)->name . '"',
                '"' . $transaction->product_name . '"',
                $transaction->quantity,
                $transaction->price,
                $transaction->total_price,
                '"' . $transaction->status . '"',
                '"' . $transaction->payment_method . '"',
                '"' . $transaction->payment_status . '"',
            ]) . "\n";
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="transactions-report.csv"',
        ]);
    }
}