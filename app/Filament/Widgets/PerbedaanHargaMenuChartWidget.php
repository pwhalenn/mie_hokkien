<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Menu;

class PerbedaanHargaMenuChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Perbedaan Harga Menu';

    protected function getData(): array
    {   

        $menu = Menu::query()->limit(10)->get();

        $namaMenu = [];
        $hargaMenu = [];

        foreach ($menu as $row) {
            $namaMenu[] = $row->name; 
            $hargaMenu[] = $row->total_harga;
        }

        return [
            'labels' => $namaMenu,
            'datasets' => [
                [
                    'label' => 'Perbedaan Harga Menu',
                    'data' => $hargaMenu,
                    'backgroundColor' =>
                        [
                            '#f87171', // Merah
                            '#fbbf24', // Kuning
                            '#34d399', // Hijau
                            '#60a5fa', // Biru Muda
                            '#818cf8', // Ungu
                            '#f472b6', // Merah Muda
                            '#facc15', // Kuning Emas
                            '#10b981', // Hijau Tua
                            '#3b82f6', // Biru
                            '#9333ea', // Ungu Tua
                        ],
                ],  
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Specifies the chart type
    }
}
