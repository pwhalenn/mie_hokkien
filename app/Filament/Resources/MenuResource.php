<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Imports\menuImport;
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

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('menu_id')
                ->label('Menu ID')
                ->required()
                ->default(fn () => Menu::max('menu_id') + 1),
                Forms\Components\TextInput::make('name')
                ->label('Name')
                ->maxLength(25)
                ->required(),
                Forms\Components\TextInput::make('deskripsi')
                ->label('Deskripsi')
                ->maxLength(150)
                ->required(),
                Forms\Components\TextInput::make('total_harga')
                ->label('Total Harga')
                ->maxLength(10)
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('menu_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')->sortable()->searchable(),
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
                        Excel::import(new menuImport, $filePath);
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
                ->modalHeading('Import Data Menu')
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
