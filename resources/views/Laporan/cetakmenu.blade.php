<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Menu</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h2>Laporan Menu</h2>
    <table>
        <thead>
        <tr>
        <th>Name</th>
        <th>Deskripsi</th>
        <th>Harga Menu</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data as $menus)
                <tr>
                    <td>{{ $menus->name}}</td>
                    <td>{{ $menus->deskripsi}}</td>
                    <td>{{ $menus->total_harga}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>