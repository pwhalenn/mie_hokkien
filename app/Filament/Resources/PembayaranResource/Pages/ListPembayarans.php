<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Resources\PembayaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;

class ListPembayarans extends ListRecords
{
    protected static string $resource = PembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('cetak_laporan')
            ->label('Cetak Pembayaran')
            ->icon('heroicon-o-printer')
            ->action(fn() => static::cetakLaporan())
            ->requiresConfirmation()
            ->modalHeading('Cetak Laporan Pembayaran')
            ->modalSubheading('Apakah Anda yakin ingin mencetak laporan pembayaran?'),

            Actions\Action::make('cetak_laporan_lengkap')
            ->label('Cetak Pembayaran Lengkap')
            ->icon('heroicon-o-printer')
            ->action(fn() => static::cetakLaporanPembayaranLengkap())
            ->requiresConfirmation()
            ->modalHeading('Cetak Laporan Pembayaran Lengkap')
            ->modalSubheading('Apakah Anda yakin ingin mencetak laporan pembayaran lengkap?'),

            Actions\CreateAction::make(), // Tombol New
        ];
    }

    public static function cetakLaporan()
    {
        // Ambil data pengguna
        $data = \App\Models\Pembayaran::all();
        // Load view untuk cetak PDF
        $pdf = \PDF::loadView('Laporan.cetakpembayaran', ['data' => $data]);
        // Unduh file PDF
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan_data_pembayaran.pdf');
    }

    public static function cetakLaporanPembayaranLengkap()
    {
        // Ambil data pengguna
        $data = DB::select('
            SELECT 
                pesanans.user_id, 
                GROUP_CONCAT(DISTINCT pembayarans.status) AS status, 
                users.name as customer_name, 
                COUNT(DISTINCT pembayarans.pesanan_id) AS total_orders, 
                SUM(pembayarans.gross_amount) AS total_gross_amount, 
                GROUP_CONCAT(DISTINCT pembayarans.transaksi_id) AS transaksi_ids, 
                GROUP_CONCAT(DISTINCT pembayarans.metode) AS metode_used
            FROM 
                pembayarans
            JOIN 
                pesanans ON pembayarans.pesanan_id = pesanans.pesanan_id
            JOIN 
                users ON pesanans.user_id = users.id
            GROUP BY 
                pesanans.user_id, users.name;
        ');
        // Load view untuk cetak PDF
        $pdf = \PDF::loadView('Laporan.cetakpembayaranlengkap', ['data' => $data]);
        // Unduh file PDF
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan_data_pembayaran_lengkap.pdf');
    }
}
