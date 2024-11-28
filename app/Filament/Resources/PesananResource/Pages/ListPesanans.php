<?php

namespace App\Filament\Resources\PesananResource\Pages;

use App\Filament\Resources\PesananResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;

class ListPesanans extends ListRecords
{
    protected static string $resource = PesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('cetak_laporan')
            ->label('Cetak Pesanan')
            ->icon('heroicon-o-printer')
            ->action(fn() => static::cetakLaporan())
            ->requiresConfirmation()
            ->modalHeading('Cetak Laporan Pesanan')
            ->modalSubheading('Apakah Anda yakin ingin mencetak laporan pesanan?'),

            Actions\Action::make('cetak_laporan_lengkap')
            ->label('Cetak Pesanan Lengkap')
            ->icon('heroicon-o-printer')
            ->action(fn() => static::cetakLaporanLengkap())
            ->requiresConfirmation()
            ->modalHeading('Cetak Laporan Pesanan Lengkap')
            ->modalSubheading('Apakah Anda yakin ingin mencetak laporan pesanan lengkap?'),

            Actions\CreateAction::make(), // Tombol New
        ];
    }

    public static function cetakLaporan()
    {
        // Ambil data pengguna
        $data = \App\Models\Pesanan::all();
        // Load view untuk cetak PDF
        $pdf = \PDF::loadView('Laporan.cetakpesanan', ['data' => $data]);
        // Unduh file PDF
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan_data_pesanan.pdf');
    }

    public static function cetakLaporanLengkap()
    {
        // Ambil data pengguna
        $data = DB::select('
            SELECT 
                item_pesanans.pesanan_id AS pesanan_id,
                users.name AS pelanggan,
                item_pesanans.name AS nama_menu,
                item_pesanans.kuantitas AS kuantitas,
                item_pesanans.harga AS total_harga
            FROM 
                item_pesanans
            JOIN 
                pesanans ON item_pesanans.pesanan_id = pesanans.pesanan_id
            JOIN 
                users ON pesanans.user_id = users.id
            LIMIT 100
        ');
        // Load view untuk cetak PDF
        $pdf = \PDF::loadView('Laporan.cetakpesananlengkap', ['data' => $data]);
        // Unduh file PDF
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan_data_pesanan_lengkap.pdf');
    }
}
