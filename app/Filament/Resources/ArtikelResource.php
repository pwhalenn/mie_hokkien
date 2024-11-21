<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtikelResource\Pages;
use App\Filament\Resources\ArtikelResource\RelationManagers;
use App\Imports\artikelImport;
use App\Models\Artikel;
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

class ArtikelResource extends Resource
{
    protected static ?string $model = Artikel::class;

    protected static ?string $navigationLabel = 'Daftar Artikel';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Informasi Menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('artikel_id')
                ->label('Artikel ID')
                ->required()
                ->default(fn () => Artikel::max('artikel_id') + 1),
                Forms\Components\TextInput::make('judul')
                ->label('Judul')
                ->maxLength(50)
                ->required(),
                Forms\Components\TextInput::make('artikel')
                ->label('Artikel')
                ->maxLength(500)
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('artikel_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('judul')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('artikel')->sortable()->searchable(),
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
                        Excel::import(new artikelImport, $filePath);
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
                ->modalHeading('Import Data Artikel')
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
            'index' => Pages\ListArtikels::route('/'),
            'create' => Pages\CreateArtikel::route('/create'),
            'edit' => Pages\EditArtikel::route('/{record}/edit'),
        ];
    }
}
