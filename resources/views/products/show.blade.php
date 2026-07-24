@extends('products.layout')

@section('content')

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-warning text-dark">
            <h3>Detail Produk BananaMart</h3>
        </div>

        <div class="card-body">

            @if($product->image)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/'.$product->image) }}"
                         width="300"
                         class="img-thumbnail">
                </div>
            @endif

            <table class="table table-bordered">

                <tr>
                    <th width="200">Nama Produk</th>
                    <td>{{ $product->name }}</td>
                </tr>

                <tr>
                    <th>Jenis Pisang</th>
                    <td>{{ $product->type }}</td>
                </tr>

                <tr>
                    <th>Harga</th>
                    <td>Rp {{ number_format($product->price,0,',','.') }}</td>
                </tr>

                <tr>
                    <th>Stok</th>
                    <td>{{ $product->stock }}</td>
                </tr>

                <tr>
                    <th>Berat</th>
                    <td>{{ $product->weight }} Kg</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($product->status) }}</td>
                </tr>

                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $product->description }}</td>
                </tr>

            </table>

            <a href="{{ route('products.index') }}"
               class="btn btn-warning">
                Kembali
            </a>

        </div>

    </div>

</div>

@endsection