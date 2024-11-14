<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(), // Tombol New
            Actions\Action::make('cetak_menu')
            ->label('Cetak Menu')
            ->icon('heroicon-o-printer')
            ->action(fn() => static::cetakMenu())
            ->requiresConfirmation()
            ->modalHeading('Cetak Menu')
            ->modalSubheading('Apakah Anda yakin ingin mencetak menu?'),
        ];
    }
    public static function cetakMenu()
    {
        // Ambil data pengguna
        // $data = \App\Models\Pembayaran::all();
        $data = \DB::select('SELECT name, deskripsi, total_harga FROM menus');
        // Load view untuk cetak PDF
        $pdf = \PDF::loadView('Laporan.cetakmenu', ['data' => $data]);
        // Unduh file PDF
        return response()->streamDownload(fn() => print($pdf->output()), 'laporan_menu.pdf');
    }
}
