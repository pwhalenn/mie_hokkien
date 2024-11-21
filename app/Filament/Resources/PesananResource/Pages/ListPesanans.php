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
            Actions\CreateAction::make(), // Tombol New
            Actions\Action::make('cetak_laporan')
            ->label('Cetak Laporan')
            ->icon('heroicon-o-printer')
            ->action(fn() => static::cetakLaporan())
            ->requiresConfirmation()
            ->modalHeading('Cetak Laporan Pesanan')
            ->modalSubheading('Apakah Anda yakin ingin mencetak laporan?'),
        ];
    }
    public static function cetakLaporan()
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
        $pdf = \PDF::loadView('Laporan.cetakpesanan', ['data' => $data]);
        // Unduh file PDF
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan_pesanan.pdf');
    }
}
