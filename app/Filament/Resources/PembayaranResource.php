<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Filament\Resources\PembayaranResource\RelationManagers;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                ->label('User ID')
                ->options(User::all()->pluck('name', 'id'))
                ->searchable(),
                Forms\Components\Select::make('pesanan_id')
                ->label('Pesanan ID')
                ->options(Pesanan::all()->pluck('pesanan_id', 'id'))
                ->searchable(),
                Forms\Components\Select::make('status')
                ->options([
                    'Bayar' => 'Bayar',
                    'Belum Bayar' => 'Belum Bayar',
                ])
                ->searchable()
                ->native(false),
                Forms\Components\TextInput::make('transaksi_id')
                ->label('Transaksi ID')
                ->maxLength(6)
                ->required(),
                Forms\Components\TextInput::make('gross_amount')
                ->label('Gross Amount')
                ->required(),
                Forms\Components\Select::make('metode')
                ->options([
                    'Cash' => 'Cash',
                    'Debit' => 'Debit',
                    'QRIS' => 'QRIS',
                ])
                ->searchable()
                ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('pesanan_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('status')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('transaksi_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('gross_amount')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('metode')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
