<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminTransactionController extends Controller
{
    public function index(Request $request): View
{
    $query = Transaction::with('user')->latest();

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('payment_status')) {
        $query->where('payment_status', $request->payment_status);
    }

    $transactions = $query->paginate(10)->withQueryString();

    return view('admin.transactions.index', compact('transactions'));
}

    public function updateStatus(Request $request, Transaction $transaction): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,processing,completed,cancelled'],
            'payment_status' => ['required', 'in:unpaid,waiting,paid'],
        ]);

        $transaction->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Status transaksi berhasil diperbarui.');
    }
}