<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Resources\PembayaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPembayarans extends ListRecords
{
    protected static string $resource = PembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(), // Tombol New
            Actions\Action::make('cetak_laporan')
            ->label('Cetak Laporan')
            ->icon('heroicon-o-printer')
            ->action(fn() => static::cetakLaporan())
            ->requiresConfirmation()
            ->modalHeading('Cetak Laporan Pembayaran')
            ->modalSubheading('Apakah Anda yakin ingin mencetak laporan?'),
        ];
    }
    public static function cetakLaporan()
    {
        // Ambil data pengguna
        // $data = \App\Models\Pembayaran::all();
        $data = \DB::select('SELECT status, transaksi_id, gross_amount, metode FROM pembayarans');
        // Load view untuk cetak PDF
        $pdf = \PDF::loadView('Laporan.cetakpembayaran', ['data' => $data]);
        // Unduh file PDF
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan_pembayaran.pdf');
    }
}
