<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Filament\Resources\PesananResource\RelationManagers;
use App\Imports\pesananImport;
use App\Models\Pesanan;
use App\Models\Item_Pesanan;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static ?string $navigationLabel = 'Daftar Pesanan';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Pemesanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('pesanan_id')
                ->label('Pesanan ID')
                ->required()
                ->default(fn () => Pesanan::max('pesanan_id') + 1),
                Forms\Components\Select::make('user_id')
                ->label('User ID')
                ->options(User::all()->pluck('name', 'id'))
                ->searchable(),
                Forms\Components\TextInput::make('total_harga')
                ->label('Total Harga')
                ->disabled()
                ->default(fn($record) => $record 
                    ? $record->items()->sum('harga')
                    : 0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pesanan_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('user_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('total_harga')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                Action::make('importExcel')
                    ->label('Import Excel')
                    ->action(function (array $data) {
                        // Pastikan $data['file'] adalah jalur yang valid di storage

                        $filePath = storage_path('app/public/' . $data['file']);

                        // Import file menggunakan jalur absolut
                        Excel::import(new pesananImport, $filePath);
                        // Tampilkan notifikasi sukses
                        Notification::make()
                            ->title('Data berhasil diimpor!')
                            ->success()
                            ->send();
                })
                ->form([
                    FileUpload::make('file')
                        ->label('Pilih File Excel')
                        ->disk('public') // Pastikan disimpan di disk 'public'
                        ->directory('imports')
                        ->acceptedFileTypes(['application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
                        ->required(),
                ])
                ->modalHeading('Import Data Pesanan')
                ->modalButton('Import')
                ->color('success'),
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
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }
}
