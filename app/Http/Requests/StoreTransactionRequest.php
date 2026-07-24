<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'quantity' => ['required', 'integer', 'min:1'],

            'payment_method' => [
                'required',
                Rule::in(['transfer_bank', 'qris', 'cod']),
            ],

            'payment_status' => [
                'nullable',
                Rule::in(['waiting', 'unpaid', 'paid']),
            ],

            'payment_proof' => [
                Rule::requiredIf(fn () => in_array($this->payment_method, ['transfer_bank', 'qris'])),
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],

            'product_name' => ['sometimes', 'string', 'max:255'],
            'price' => ['sometimes', 'numeric', 'min:0'],
            'status' => ['sometimes', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.required' => 'Jumlah pembelian wajib diisi.',
            'quantity.integer' => 'Jumlah pembelian harus berupa angka.',
            'quantity.min' => 'Jumlah pembelian minimal 1.',

            'payment_method.required' => 'Silakan pilih metode pembayaran.',
            'payment_method.in' => 'Metode pembayaran tidak valid.',

            'payment_status.in' => 'Status pembayaran tidak valid.',

            'payment_proof.required' => 'Bukti pembayaran wajib diunggah untuk metode transfer bank atau QRIS.',
            'payment_proof.image' => 'Bukti pembayaran harus berupa gambar.',
            'payment_proof.mimes' => 'Bukti pembayaran harus berformat JPG, JPEG, atau PNG.',
            'payment_proof.max' => 'Ukuran bukti pembayaran maksimal 2 MB.',

            'product_name.string' => 'Nama produk tidak valid.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh kurang dari 0.',
            'status.string' => 'Status transaksi tidak valid.',
        ];
    }
}