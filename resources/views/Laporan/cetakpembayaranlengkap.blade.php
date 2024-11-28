<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembayaran Lengkap</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h2>Laporan Pembayaran Lengkap</h2>
    <table>
        <thead>
        <tr>
        <th>Status</th>
        <th>Pelanggan</th>
        <th>Total Pesanan</th>
        <th>Transaksi ID</th>
        <th>Total Harga</th>
        <th>Metode</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data as $rows)
                <tr>
                    <td>{{ $rows->status }}</td>
                    <td>{{ $rows->customer_name }}</td>
                    <td>{{ $rows->total_orders }}</td>
                    <td>{{ $rows->transaksi_ids }}</td>
                    <td>{{ $rows->total_gross_amount }}</td>
                    <td>{{ $rows->metode_used }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>