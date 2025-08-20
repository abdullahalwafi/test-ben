<?php

namespace App\Filament\Resources\DatasetResource\Pages;

use App\Filament\Resources\DatasetResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CreateDataset extends CreateRecord
{
    protected static string $resource = DatasetResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!empty($data['files'])) {
            $path = $data['files'];
            $fullPath = Storage::disk('public')->path($path);

            $parsed = $this->parseSpreadsheetToArray($fullPath);
            $data['meta_data_json'] = $parsed;
        }

        $data['last_update'] = now();
        return $data;
    }

    private function parseSpreadsheetToArray(string $fullPath): array
    {
        $spreadsheet = IOFactory::load($fullPath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = [];
        foreach ($sheet->toArray(null, true, true, true) as $rIdx => $row) {
            $rows[] = array_values($row);
        }
        // Asumsikan baris pertama header
        $headers = $rows[0] ?? [];
        $dataRows = array_slice($rows, 1);
        return [
            'headers' => $headers,
            'rows'    => $dataRows,
        ];
    }
}
