<?php

namespace App\Filament\Resources\ReservasiResource\Pages;

use App\Filament\Resources\ReservasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReservasis extends ListRecords
{
    protected static string $resource = ReservasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(), // Tombol New
            Actions\Action::make('cetak_laporan')
            ->label('Cetak Laporan')
            ->icon('heroicon-o-printer')
            ->action(fn() => static::cetakLaporan())
            ->requiresConfirmation()
            ->modalHeading('Cetak Laporan Reservasi')
            ->modalSubheading('Apakah Anda yakin ingin mencetak laporan?'),
        ];
    }
    public static function cetakLaporan()
    {
        // Ambil data reservasi
        // $data = \App\Models\Reservasi::all();
        $data = \DB::select('SELECT name, tanggal, waktu, meja, jumlah_pax, status FROM reservasis');
        // Load view untuk cetak PDF
        $pdf = \PDF::loadView('Laporan.cetakreservasi', ['data' => $data]);
        // Unduh file PDF
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan_reservasi.pdf');
    }
}
