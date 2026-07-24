@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                <div class="card-header border-0 text-white"
                     style="background:linear-gradient(135deg,#FFD54F,#F9A825);">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <h2 class="fw-bold mb-1">
                                🍌 Tambah Produk Baru
                            </h2>

                            <p class="mb-0">
                                Tambahkan produk pisang terbaik ke BananaMart
                            </p>
                        </div>

                        <div style="font-size:70px;">
                            🍌
                        </div>

                    </div>

                </div>

                <div class="card-body p-5">

                    @if($errors->any())

                    <div class="alert alert-danger rounded-3">

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                    @endif

                    <form action="{{ route('products.store') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-4">

                                    <label class="form-label fw-bold">
                                        Nama Produk
                                    </label>

                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control premium-input"
                                        placeholder="Contoh : Pisang Ambon">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="mb-4">

                                    <label class="form-label fw-bold">
                                        Jenis Pisang
                                    </label>

                                    <input
                                        type="text"
                                        name="type"
                                        class="form-control premium-input"
                                        placeholder="Ambon">

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">

                                <div class="mb-4">

                                    <label class="form-label fw-bold">

                                        Harga

                                    </label>

                                    <input
                                        type="number"
                                        name="price"
                                        class="form-control premium-input"
                                        placeholder="25000">

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="mb-4">

                                    <label class="form-label fw-bold">

                                        Stok

                                    </label>

                                    <input
                                        type="number"
                                        name="stock"
                                        class="form-control premium-input"
                                        placeholder="100">

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="mb-4">

                                    <label class="form-label fw-bold">

                                        Berat (Kg)

                                    </label>

                                    <input
                                        type="number"
                                        step="0.01"
                                        name="weight"
                                        class="form-control premium-input"
                                        placeholder="1">

                                </div>

                            </div>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-bold">

                                Status Produk

                            </label>

                            <select
                                class="form-select premium-input"
                                name="status">

                                <option value="available">

                                    ✅ Tersedia

                                </option>

                                <option value="out_of_stock">

                                    ❌ Habis

                                </option>

                            </select>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-bold">

                                Deskripsi

                            </label>

                            <textarea
                                rows="5"
                                class="form-control premium-input"
                                name="description"
                                placeholder="Masukkan deskripsi produk..."></textarea>

                        </div>

                        <div class="mb-5">

                            <label class="form-label fw-bold">

                                Upload Gambar Produk

                            </label>

                            <input
                                type="file"
                                class="form-control premium-input"
                                name="image"
                                id="image">

                            <div class="text-center mt-4">

                                <img
                                    id="preview"
                                    src="https://placehold.co/250x250?text=Preview"
                                    class="rounded shadow border"
                                    style="max-width:250px">

                            </div>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('products.index') }}"
                               class="btn btn-outline-secondary btn-lg px-4">

                                ← Kembali

                            </a>

                            <button
                                class="btn btn-warning btn-lg px-5 fw-bold shadow">

                                💾 Simpan Produk

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

document.getElementById('image').onchange=function(e){

    const reader=new FileReader();

    reader.onload=function(){

        document.getElementById('preview').src=reader.result;

    }

    reader.readAsDataURL(e.target.files[0]);

}

</script>

@endsection