<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\Product;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function create(Product $product): View
    {
        return view('transactions.create', compact('product'));
    }

    public function storeWeb(StoreTransactionRequest $request, Product $product): RedirectResponse
    {
        $quantity = (int) $request->quantity;

        if ($quantity < 1) {
            return back()->withErrors([
                'quantity' => 'Jumlah pembelian minimal 1.',
            ])->withInput();
        }

        if ($product->stock < $quantity) {
            return back()->withErrors([
                'quantity' => 'Stok produk tidak mencukupi.',
            ])->withInput();
        }

        $paymentProofPath = null;

        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        $paymentStatus = $request->payment_method === 'cod' ? 'unpaid' : 'waiting';

        $transaction = DB::transaction(function () use ($request, $product, $quantity, $paymentProofPath, $paymentStatus) {
            $price = (float) $product->price;

            $transaction = Transaction::create([
                'transaction_number' => 'TRX-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(5)),
                'user_id' => auth()->id(),
                'product_name' => $product->name,
                'quantity' => $quantity,
                'price' => $price,
                'total_price' => $quantity * $price,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => $paymentStatus,
                'payment_proof' => $paymentProofPath,
            ]);

            $product->decrement('stock', $quantity);

            return $transaction;
        });

        return redirect()
            ->route('transactions.show', $transaction)
            ->with('success', 'Pesanan berhasil dibuat. Silakan tunggu verifikasi pembayaran.');
    }

    public function history(): View
    {
        $transactions = Transaction::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    public function showWeb(Transaction $transaction): View
    {
        abort_unless(
            auth()->id() === $transaction->user_id || auth()->user()?->role === 'admin',
            403
        );

        return view('transactions.show', compact('transaction'));
    }

    public function exportPdf(Request $request)
    {
        $transactions = Transaction::with('user')
            ->when($request->status, fn ($query) => $query->where('status', $request->status))
            ->when($request->payment_status, fn ($query) => $query->where('payment_status', $request->payment_status))
            ->latest()
            ->get();

        $pdf = Pdf::loadView('admin.transactions.pdf', compact('transactions'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-transaksi-bananamart.pdf');
    }

    public function index(): JsonResponse
    {
        $transactions = Transaction::with('user')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar transaksi berhasil diambil',
            'data' => $transactions,
        ]);
    }

    public function store(StoreTransactionRequest $request): JsonResponse
    {
        $paymentProofPath = $request->hasFile('payment_proof')
            ? $request->file('payment_proof')->store('payment_proofs', 'public')
            : null;

        $quantity = (int) $request->quantity;
        $price = (float) $request->price;

        $paymentStatus = $request->payment_method === 'cod'
            ? 'unpaid'
            : ($request->payment_status ?? 'waiting');

        $transaction = Transaction::create([
            'transaction_number' => 'TRX-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(5)),
            'user_id' => auth()->id(),
            'product_name' => $request->product_name,
            'quantity' => $quantity,
            'price' => $price,
            'total_price' => $quantity * $price,
            'status' => $request->status ?? 'pending',
            'payment_method' => $request->payment_method,
            'payment_proof' => $paymentProofPath,
            'payment_status' => $paymentStatus,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dibuat',
            'data' => $transaction->load('user'),
        ], 201);
    }

    public function show(Transaction $transaction): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $transaction->load('user'),
        ]);
    }

    public function updateStatus(Request $request, Transaction $transaction): JsonResponse
    {
        $request->validate([
            'status' => ['nullable', 'string', 'max:50'],
            'payment_status' => ['nullable', 'in:unpaid,waiting,paid'],
        ]);

        $transaction->update([
            'status' => $request->status ?? $transaction->status,
            'payment_status' => $request->payment_status ?? $transaction->payment_status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status transaksi berhasil diperbarui',
            'data' => $transaction,
        ]);
    }

    public function destroy(Transaction $transaction): JsonResponse
    {
        if ($transaction->payment_proof && Storage::disk('public')->exists($transaction->payment_proof)) {
            Storage::disk('public')->delete($transaction->payment_proof);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dihapus',
        ]);
    }
}