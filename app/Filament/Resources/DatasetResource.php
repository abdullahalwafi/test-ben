<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DatasetResource\Pages;
use App\Filament\Resources\DatasetResource\RelationManagers;
use App\Models\Dataset;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Topik;

class DatasetResource extends Resource
{
    protected static ?string $model = Dataset::class;
    protected static ?string $navigationIcon = 'heroicon-m-rectangle-stack';
    protected static ?string $navigationLabel = 'Dataset';
    protected static ?string $modelLabel = 'Dataset';
    protected static ?string $navigationGroup = 'Manajemen Dataset';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('id_topik')
                ->label('Topik')
                ->options(Topik::query()->pluck('topik', 'id_topik'))
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('nama_dataset')
                ->label('Nama Dataset')
                ->required()
                ->maxLength(255),

            Forms\Components\FileUpload::make('files')
                ->label('Upload File (Excel)')
                ->directory('datasets')
                ->acceptedFileTypes([
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/vnd.ms-excel',
                    'text/csv',
                ])
                ->helperText('Hanya .xlsx/.xls/.csv')
                ->preserveFilenames()
                ->downloadable()
                ->openable()
                ->required(),

            Forms\Components\Textarea::make('metadata_info')
                ->label('Meta Data Info')
                ->rows(3),

            Forms\Components\KeyValue::make('meta_data_json')
                ->label('Preview JSON (read-only)')
                ->disableAddingRows()
                ->disableDeletingRows()
                ->disabled()
                ->helperText('Terisi otomatis saat submit dari isi Excel'),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('topik.topik')->label('Topik')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nama_dataset')->searchable()->wrap(),
                Tables\Columns\TextColumn::make('last_update')->dateTime()->label('Last Update')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->since()->label('Created'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('id_topik')
                    ->label('Filter Topik')
                    ->options(Topik::query()->pluck('topik', 'id_topik')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDatasets::route('/'),
            'create' => Pages\CreateDataset::route('/create'),
            'edit'   => Pages\EditDataset::route('/{record}/edit'),
            'view'   => Pages\ViewDataset::route('/{record}'),
        ];
    }
}
