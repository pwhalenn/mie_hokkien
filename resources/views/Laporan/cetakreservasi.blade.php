<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Reservasi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h2>Laporan Reservasi</h2>
    <table>
        <thead>
        <tr>
        <th>Name</th>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>Meja</th>
        <th>Jumplah Pax</th>
        <th>Status</th>
        </tr>
        </thead>
        <tbody>
            @foreach($data as $reservasis)
                <tr>
                    <td>{{ $reservasis->name}}</td>
                    <td>{{ $reservasis->tanggal}}</td>
                    <td>{{ $reservasis->waktu}}</td>
                    <td>{{ $reservasis->meja}}</td>
                    <td>{{ $reservasis->jumlah_pax}}</td>
                    <td>{{ $reservasis->status}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>