@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-header bg-warning text-dark rounded-top-4 py-3">
                    <h2 class="fw-bold mb-0">
                        🍌 Edit Produk BananaMart
                    </h2>
                    <small>Perbarui informasi produk pisang</small>
                </div>

                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('products.update',$product->id) }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Nama Produk
                                </label>

                                <input
                                    type="text"
                                    class="form-control form-control-lg"
                                    name="name"
                                    value="{{ old('name',$product->name) }}">
                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Jenis Pisang
                                </label>

                                <input
                                    type="text"
                                    class="form-control form-control-lg"
                                    name="type"
                                    value="{{ old('type',$product->type) }}">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label class="form-label fw-semibold">
                                    Harga
                                </label>

                                <input
                                    type="number"
                                    class="form-control"
                                    name="price"
                                    value="{{ old('price',$product->price) }}">
                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label fw-semibold">
                                    Stok
                                </label>

                                <input
                                    type="number"
                                    class="form-control"
                                    name="stock"
                                    value="{{ old('stock',$product->stock) }}">
                            </div>

                            <div class="col-md-4 mb-3">

                                <label class="form-label fw-semibold">
                                    Berat (Kg)
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    class="form-control"
                                    name="weight"
                                    value="{{ old('weight',$product->weight) }}">
                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Status
                            </label>

                            <select class="form-select"
                                    name="status">

                                <option value="available"
                                    {{ $product->status=='available'?'selected':'' }}>
                                    ✅ Tersedia
                                </option>

                                <option value="out_of_stock"
                                    {{ $product->status=='out_of_stock'?'selected':'' }}>
                                    ❌ Habis
                                </option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Deskripsi
                            </label>

                            <textarea
                                rows="5"
                                class="form-control"
                                name="description">{{ old('description',$product->description) }}</textarea>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Foto Produk
                            </label>

                            <input
                                type="file"
                                class="form-control"
                                name="image">

                            @if($product->image)

                                <div class="mt-3">

                                    <img
                                        src="{{ asset('storage/'.$product->image) }}"
                                        class="img-thumbnail shadow"
                                        width="220">

                                </div>

                            @endif

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('products.index') }}"
                               class="btn btn-outline-secondary btn-lg">

                                ← Kembali

                            </a>

                            <button
                                class="btn btn-warning btn-lg px-5 fw-bold">

                                💾 Simpan Perubahan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection