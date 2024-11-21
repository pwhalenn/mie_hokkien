<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemPesananResource\Pages;
use App\Filament\Resources\ItemPesananResource\RelationManagers;
use App\Imports\itemPesananImport;
use App\Models\Item_Pesanan;
use App\Models\Pesanan;
use App\Models\Menu;
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

class ItemPesananResource extends Resource
{
    protected static ?string $model = Item_Pesanan::class;

    protected static ?string $navigationLabel = 'Daftar Item Pesanan';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Pemesanan';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('item_pesanan_id')
                ->label('Item Pesanan ID')
                ->required()
                ->default(fn () => Item_Pesanan::max('item_pesanan_id') + 1),
            
            Forms\Components\Select::make('pesanan_id')
            ->label('Pesanan ID')
            ->options(Pesanan::all()->pluck('pesanan_id', 'id'))
            ->searchable()
            ->reactive()
            ->afterStateUpdated(function ($set, $get, $state, $record) {
                if ($record && $record->pesanan_id != $state) {
                    $oldPesanan = Pesanan::find($record->pesanan_id);
                    if ($oldPesanan) {
                        $oldPesanan->updateTotalHarga();
                    }
                }
                $newPesanan = Pesanan::find($state);
                if ($newPesanan) {
                    $newPesanan->updateTotalHarga();
                }
            }),
            

            Forms\Components\TextInput::make('kuantitas')
                ->label('Quantity')
                ->numeric()
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($set, $get, $state) {
                    $menuName = $get('name');
                    $menu = Menu::where('name', $menuName)->first();
                    if ($menu) {
                        $set('harga', $menu->total_harga * $state);
                    }
                }),

            Forms\Components\Select::make('name')
                ->label('Menu Item')
                ->options(Menu::all()->pluck('name', 'name'))
                ->searchable()
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($set, $get, $state) {
                    $kuantitas = $get('kuantitas');
                    $menu = Menu::where('name', $state)->first();
                    if ($menu) {
                        $set('harga', $menu->total_harga * $kuantitas);
                    }
                }),
            Forms\Components\TextInput::make('harga')
                ->label('Harga')
                ->disabled()
                ->numeric()
                ->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('item_pesanan_id')->sortable()->searchable(),
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
            ->headerActions([
                Action::make('importExcel')
                    ->label('Import Excel')
                    ->action(function (array $data) {
                        // Pastikan $data['file'] adalah jalur yang valid di storage

                        $filePath = storage_path('app/public/' . $data['file']);

                        // Import file menggunakan jalur absolut
                        Excel::import(new itemPesananImport, $filePath);
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
            'index' => Pages\ListItemPesanans::route('/'),
            'create' => Pages\CreateItemPesanan::route('/create'),
            'edit' => Pages\EditItemPesanan::route('/{record}/edit'),
        ];
    }
}
