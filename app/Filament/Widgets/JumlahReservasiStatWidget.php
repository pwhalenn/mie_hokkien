<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\DB;

class JumlahReservasiStatWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $jumlahReservasi = DB::table('reservasis')->count();

        return [
            Card::make('Jumlah Reservasi', $jumlahReservasi)
            ->description('Jumlah Reservasi saat ini')
            ->descriptionIcon('heroicon-s-chat-bubble-bottom-center')
            ->color('success'), // warning orange, error merah

        ];
    }
}
