<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Filament\Resources\PembayaranResource\RelationManagers;
use App\Models\Pembayaran;
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
                Forms\Components\Select::make('status')
                ->options([
                    'Bayar' => 'Bayar',
                    'Belum Bayar' => 'Belum Bayar',
                ])
                ->searchable()
                ->native(false),
                Forms\Components\TextInput::make('transaksiID')
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
                    'Credit' => 'Credit',
                ])
                ->searchable()
                ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('transaksiID')->sortable()->searchable(),
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
