<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data User Lengkap</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .user-block { border: 1px solid #ddd; padding: 10px; margin-bottom: 20px; }
        .user-block h3 { margin: 0; }
        .user-block p { margin: 5px 0; }
        .order-list { padding-left: 20px; }
        .order-item { margin-bottom: 10px; }
        .order-header { font-weight: bold; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <h2>Laporan Data Pelanggan Lengkap</h2>
    
    @foreach($data as $row)
        <div class="user-block">
            <h3>{{ $row->pelanggan }} (User ID: {{ $row->user_id }})</h3>
            <p>Email: {{ $row->email }}</p>
            <p>Tanggal Reservasi: {{ $row->tanggal_reservasi }}</p>
            <p>No Reservasi Meja: {{ $row->no_reservasi_meja }}</p>
            <p>Jumlah Orang (Pax): {{ $row->jumlah_orang }}</p>

            <div class="order-list">
                <div class="order-item">
                    <p class="order-header">Pesanan:</p>
                    <p>{{ $row->pesanan_ids }}</p>
                </div>

                <div class="order-item">
                    <p class="order-header">Nama Menu:</p>
                    <p>{{ $row->nama_menu }}</p>
                </div>

                <div class="order-item">
                    <p class="order-header">Kuantitas Pesanan:</p>
                    <p>{{ $row->kuantitas }}</p>
                </div>
                
                <div class="order-item">
                    <p class="total">Total Harga: {{ $row->total_harga }}</p>
                </div>

                <div class="order-item">
                    <p class="order-header">Metode Pembayaran:</p>
                    <p>{{ $row->metode_pembayaran }}</p>
                </div>

                <div class="order-item">
                    <p class="order-header">Status Pembayaran:</p>
                    <p>{{ $row->status_pembayaran }}</p>
                </div>
            </div>
        </div>
    @endforeach
</body>
</html>
