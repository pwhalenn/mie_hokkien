<?php

namespace App\Filament\Resources\ArtikelResource\Pages;

use App\Filament\Resources\ArtikelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArtikels extends ListRecords
{
    protected static string $resource = ArtikelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('cetak_laporan')
            ->label('Cetak Artikel')
            ->icon('heroicon-o-document-text')
            ->action(fn() => static::cetakLaporan())
            ->requiresConfirmation()
            ->modalHeading('Cetak Laporan Data Artikel')
            ->modalSubheading('Apakah Anda yakin ingin mencetak data artikel?'),

            Actions\CreateAction::make(), // Tombol New
        ];
    }

    public static function cetakLaporan()
    {
        // Ambil data pengguna
        $data = \App\Models\Artikel::all();
        // Load view untuk cetak PDF
        $pdf = \PDF::loadView('Laporan.cetakartikel', ['data' => $data]);
        // Unduh file PDF
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan_data_artikel.pdf');
    }
}
