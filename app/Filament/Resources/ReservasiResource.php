<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservasiResource\Pages;
use App\Filament\Resources\ReservasiResource\RelationManagers;
use App\Models\Reservasi;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservasiResource extends Resource
{
    protected static ?string $model = Reservasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                ->label('User ID')
                ->options(User::all()->pluck('name', 'id'))
                ->searchable(),
                Forms\Components\TextInput::make('name')
                ->label('Name')
                ->maxLength(25)
                ->required(),
                Forms\Components\DatePicker::make('tanggal')
                ->label('Tanggal')
                ->required(),
                Forms\Components\TimePicker::make('waktu')
                ->label('Waktu')
                ->required(),
                Forms\Components\TextInput::make('meja')
                ->label('Meja')
                ->required()
                ->numeric(),
                Forms\Components\TextInput::make('jumlah_pax')
                ->label('Jumlah Pax')
                ->required()
                ->numeric(),
                Forms\Components\Select::make('status')
                ->options([
                    'Available' => 'Available',
                    'Pending' => 'Pending',
                    'Reserved' => 'Reserved',
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
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('tanggal')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('waktu')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('meja')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jumlah_pax')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('status')->sortable()->searchable(),
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
            'index' => Pages\ListReservasis::route('/'),
            'create' => Pages\CreateReservasi::route('/create'),
            'edit' => Pages\EditReservasi::route('/{record}/edit'),
        ];
    }
}
