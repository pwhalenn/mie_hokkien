<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Item Pesanan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h2>Laporan Item Pesanan</h2>
    <table>
        <thead>
        <tr>
        <th>Item Pesanan ID</th>
        <th>Pesanan ID</th>
        <th>Kuantitas</th>
        <th>Name</th>
        <th>Harga</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data as $rows)
                <tr>
                    <td>{{ $rows->item_pesanan_id}}</td>
                    <td>{{ $rows->pesanan_id}}</td>
                    <td>{{ $rows->kuantitas}}</td>
                    <td>{{ $rows->name}}</td>
                    <td>{{ $rows->harga}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>