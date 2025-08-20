<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TopikResource\Pages;
use App\Filament\Resources\TopikResource\RelationManagers;
use App\Models\Topik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TopikResource extends Resource
{
    protected static ?string $model = Topik::class;
    protected static ?string $navigationIcon = 'heroicon-m-tag';
    protected static ?string $navigationLabel = 'Topik';
    protected static ?string $modelLabel = 'Topik';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('topik')
                ->label('Nama Topik')
                ->maxLength(150)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_topik')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('topik')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->since(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('id_topik', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTopiks::route('/'),
            'create' => Pages\CreateTopik::route('/create'),
            'edit' => Pages\EditTopik::route('/{record}/edit'),
        ];
    }
}
