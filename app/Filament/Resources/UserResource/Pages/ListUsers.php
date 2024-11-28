<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('cetak_laporan')
            ->label('Cetak User')
            ->icon('heroicon-o-printer')
            ->action(fn() => static::cetakLaporan())
            ->requiresConfirmation()
            ->modalHeading('Cetak Laporan User')
            ->modalSubheading('Apakah Anda yakin ingin mencetak data user?'),

            Actions\Action::make('cetak_laporan_lengkap')
            ->label('Cetak User Lengkap')
            ->icon('heroicon-o-printer')
            ->action(fn() => static::cetakLaporanLengkap())
            ->requiresConfirmation()
            ->modalHeading('Cetak Laporan User Lengkap')
            ->modalSubheading('Apakah Anda yakin ingin mencetak data user lengkap?'),

            Actions\CreateAction::make(), // Tombol New
        ];
    }

    public static function cetakLaporan()
    {
        // Ambil data pengguna
        $data = \App\Models\User::all();
        // Load view untuk cetak PDF
        $pdf = \PDF::loadView('Laporan.cetakpelanggan', ['data' => $data]);
        // Unduh file PDF
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan_data_user.pdf');
    }

    public static function cetakLaporanLengkap()
    {
        // Ambil data pengguna
        $data = DB::select('
            SELECT  
                users.id AS user_id,
                users.email AS email,
                users.name AS pelanggan,
                reservasis.tanggal AS tanggal_reservasi,
                reservasis.meja AS no_reservasi_meja,
                reservasis.jumlah_pax AS jumlah_orang,
                GROUP_CONCAT(DISTINCT pesanans.pesanan_id SEPARATOR ", ") AS pesanan_ids,
                GROUP_CONCAT(DISTINCT item_pesanans.name SEPARATOR ", ") AS nama_menu,
                GROUP_CONCAT(DISTINCT item_pesanans.kuantitas SEPARATOR ", ") AS kuantitas,
                GROUP_CONCAT(DISTINCT item_pesanans.harga SEPARATOR ", ") AS total_harga,
                pembayarans.metode AS metode_pembayaran,
                pembayarans.status AS status_pembayaran
            FROM 
                item_pesanans
            JOIN 
                pesanans ON item_pesanans.pesanan_id = pesanans.pesanan_id
            JOIN 
                users ON pesanans.user_id = users.id
            JOIN 
                reservasis ON reservasis.user_id = pesanans.user_id
            JOIN 
                pembayarans ON pembayarans.pesanan_id = pesanans.pesanan_id
            GROUP BY 
                users.id, users.email, users.name, reservasis.tanggal, reservasis.meja, 
                reservasis.jumlah_pax, pembayarans.metode, pembayarans.status
        ');
        
        // Load view untuk cetak PDF
        $pdf = \PDF::loadView('Laporan.cetakpelangganlengkap', ['data' => $data]);

        // Unduh file PDF
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan_data_user_lengkap.pdf');
    }
}
