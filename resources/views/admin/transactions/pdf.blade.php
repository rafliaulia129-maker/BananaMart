<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi BananaMart</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin-top: 0;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #999;
        }

        th {
            background-color: #f4d03f;
            color: #7D6608;
            padding: 8px;
            text-align: left;
        }

        td {
            padding: 7px;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Laporan Transaksi BananaMart</h2>
    <p>Data seluruh transaksi admin</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Transaksi</th>
                <th>User</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Metode</th>
                <th>Status Bayar</th>
                <th>Status Pesanan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $transaction)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $transaction->transaction_number }}</td>
                    <td>{{ $transaction->user->name ?? 'User tidak ditemukan' }}</td>
                    <td>{{ $transaction->product_name }}</td>
                    <td class="text-center">{{ $transaction->quantity }}</td>
                    <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                    <td>{{ strtoupper(str_replace('_', ' ', $transaction->payment_method ?? '-')) }}</td>
                    <td>{{ ucfirst($transaction->payment_status ?? '-') }}</td>
                    <td>{{ ucfirst($transaction->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Belum ada transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>