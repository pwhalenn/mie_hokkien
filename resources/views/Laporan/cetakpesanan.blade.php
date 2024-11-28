<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pesanan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h2>Laporan Pesanan</h2>
    <table>
        <thead>
        <tr>
        <th>Pesanan ID</th>
        <th>User ID</th>
        <th>Total Harga</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data as $rows)
                <tr>
                    <td>{{ $rows->pesanan_id }}</td>
                    <td>{{ $rows->user_id }}</td>
                    <td>{{ $rows->total_harga }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>