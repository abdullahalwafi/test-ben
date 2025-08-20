<?php

namespace App\Filament\Resources\DatasetResource\Pages;

use App\Filament\Resources\DatasetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class EditDataset extends EditRecord
{
    protected static string $resource = DatasetResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Jika file diganti, parse ulang
        if (!empty($data['files']) && $this->record->files !== $data['files']) {
            $fullPath = Storage::disk('public')->path($data['files']);
            $data['meta_data_json'] = $this->parseSpreadsheetToArray($fullPath);
        }
        $data['last_update'] = now();
        return $data;
    }

    private function parseSpreadsheetToArray(string $fullPath): array
    {
        $spreadsheet = IOFactory::load($fullPath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = [];
        foreach ($sheet->toArray(null, true, true, true) as $row) {
            $rows[] = array_values($row);
        }
        $headers = $rows[0] ?? [];
        $dataRows = array_slice($rows, 1);
        return ['headers' => $headers, 'rows' => $dataRows];
    }
}
