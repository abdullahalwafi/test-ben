<?php

namespace App\Filament\Resources\TopikResource\Pages;

use App\Filament\Resources\TopikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTopik extends EditRecord
{
    protected static string $resource = TopikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
