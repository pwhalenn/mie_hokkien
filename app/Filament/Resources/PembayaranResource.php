<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Filament\Resources\PembayaranResource\RelationManagers;
use App\Imports\pembayaranImport;
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
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationLabel = 'Daftar Pembayaran';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Pembayaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('pembayaran_id')
                ->label('Pembayaran ID')
                ->required()
                ->default(fn () => Pembayaran::max('pembayaran_id') + 1),
                Forms\Components\Select::make('user_id')
                ->label('User ID')
                ->options(User::all()->pluck('name', 'id'))
                ->searchable()
                ->default(fn ($record) => $record ? $record->pesanan->user_id : null),
                Forms\Components\Select::make('pesanan_id')
                ->label('Pesanan ID')
                ->options(Pesanan::all()->pluck('pesanan_id', 'id'))
                ->searchable()
                ->reactive()
                ->afterStateUpdated(function (callable $set, $state) {
                    $pesanan = Pesanan::find($state);
                    if ($pesanan) {
                        $set('user_id', $pesanan->user_id);
                        $set('gross_amount', $pesanan->total_harga);
                    }
                }),
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
                ->required()
                ->default(fn ($record) => $record ? $record->pesanan->total_harga : null),
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
                Tables\Columns\TextColumn::make('pembayaran_id')->sortable()->searchable(),
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
            ->headerActions([
                Action::make('importExcel')
                    ->label('Import Excel')
                    ->action(function (array $data) {
                        // Pastikan $data['file'] adalah jalur yang valid di storage

                        $filePath = storage_path('app/public/' . $data['file']);

                        // Import file menggunakan jalur absolut
                        Excel::import(new pembayaranImport, $filePath);
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
                ->modalHeading('Import Data Pembayaran')
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
