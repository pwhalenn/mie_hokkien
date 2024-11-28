<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembayaran</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h2>Laporan Pembayaran</h2>
    <table>
        <thead>
        <tr>
        <th>User ID</th>
        <th>Pesanan ID</th>
        <th>Status</th>
        <th>Transaksi ID</th>
        <th>Total Harga</th>
        <th>Metode</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data as $rows)
                <tr>
                    <td>{{ $rows->user_id }}</td>
                    <td>{{ $rows->pesanan_id }}</td>
                    <td>{{ $rows->status }}</td>
                    <td>{{ $rows->transaksi_id }}</td>
                    <td>{{ $rows->gross_amount }}</td>
                    <td>{{ $rows->metode }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>