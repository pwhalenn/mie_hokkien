<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\pembayaran;

class PembayaranTabelWidget extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                pembayaran::query()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('pembayaran_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('user_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('status')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('transaksi_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('gross_amount')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('metode')->sortable()->searchable(),
            ]);
    }
}
