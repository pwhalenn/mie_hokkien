<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Pelanggan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h2>Laporan Data Pelanggan</h2>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Email</th>
                <th>Nama</th>
                <th>Tanggal Reservasi</th>
                <th>No Reservasi Meja</th>
                <th>Jumlah Orang (Pax)</th>
                <th>Pesanan</th>
                <th>Kuantitas Pesanan</th>
                <th>@</th>
                <th>Total Harga</th>
                <th>Metode Pembayaran</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    <td>{{ $row->user_id }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->pelanggan }}</td>
                    <td>{{ $row->tanggal_reservasi }}</td>
                    <td>{{ $row->no_reservasi_meja }}</td>
                    <td>{{ $row->jumlah_orang }}</td>
                    <td>{{ $row->pesanan_ids }}</td>
                    <td>{{ $row->nama_menu }}</td>
                    <td>{{ $row->kuantitas }}</td>
                    <td>{{ $row->harga_menu }}</td>
                    <td>{{ $row->total_harga }}</td>
                    <td>{{ $row->metode_pembayaran }}</td>
                    <td>{{ $row->status_pembayaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>