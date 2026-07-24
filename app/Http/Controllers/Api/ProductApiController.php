<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data produk BananaMart berhasil diambil',
            'data' => $products
        ]);
    }
}