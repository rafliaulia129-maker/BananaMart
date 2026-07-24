<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalTransactions = Transaction::count();

        $totalSales = Transaction::where('status', 'completed')
            ->sum('total_price');

        $latestTransactions = Transaction::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Tambahkan ini
        $products = Product::where('status', 'available')
            ->where('stock', '>', 0)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalTransactions',
            'totalSales',
            'latestTransactions',
            'products'
        ));
    }
}