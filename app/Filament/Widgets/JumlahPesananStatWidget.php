<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\DB;

class JumlahPesananStatWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $jumlahPesanan = DB::table('pesanans')->count();

        return [
            Card::make('Jumlah Pesanan', $jumlahPesanan)
            ->description('Jumlah Pesanan saat ini')
            ->descriptionIcon('heroicon-s-clipboard-document-list')
            ->color('success'), // warning orange, error merah

        ];
    }
}
