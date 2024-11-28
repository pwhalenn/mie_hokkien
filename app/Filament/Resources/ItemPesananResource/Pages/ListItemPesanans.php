<?php

namespace App\Filament\Resources\ItemPesananResource\Pages;

use App\Filament\Resources\ItemPesananResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemPesanans extends ListRecords
{
    protected static string $resource = ItemPesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('cetak_menu')
                ->label('Cetak Item Pesanan')
                ->icon('heroicon-o-printer')
                ->action(fn() => static::cetakItemPesanan())
                ->requiresConfirmation()
                ->modalHeading('Cetak Item Pesanan')
                ->modalSubheading('Apakah Anda yakin ingin mencetak item pesanan?'),

                Actions\CreateAction::make(), // Tombol New
        ];
    }

    public static function cetakItemPesanan()
    {
        // Ambil data pengguna
        $data = \App\Models\item_pesanan::all();
        // Load view untuk cetak PDF
        $pdf = \PDF::loadView('Laporan.cetakitempesanan', ['data' => $data]);
        // Unduh file PDF
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan_data_item_pesanan.pdf');
    }
}
