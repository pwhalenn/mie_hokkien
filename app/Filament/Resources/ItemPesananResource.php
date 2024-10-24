<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemPesananResource\Pages;
use App\Filament\Resources\ItemPesananResource\RelationManagers;
use App\Models\Item_Pesanan;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemPesananResource extends Resource
{
    protected static ?string $model = Item_Pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pesanan_id')
                ->label('Pesanan ID')
                ->options(Pesanan::all()->pluck('pesanan_id', 'id'))
                ->searchable(),
                Forms\Components\TextInput::make('kuantitas')
                ->label('Kuantitas')
                ->maxLength(2)
                ->required(),
                Forms\Components\TextInput::make('name')
                ->label('Name')
                ->maxLength(25)
                ->required(),
                Forms\Components\TextInput::make('harga')
                ->label('Harga')
                ->maxLength(10)
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pesanan_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('kuantitas')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('harga')->sortable()->searchable(),
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
            'index' => Pages\ListItemPesanans::route('/'),
            'create' => Pages\CreateItemPesanan::route('/create'),
            'edit' => Pages\EditItemPesanan::route('/{record}/edit'),
        ];
    }
}
