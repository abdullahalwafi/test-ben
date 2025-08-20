<?php

namespace Database\Seeders;

use App\Models\Topik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Kependudukan', 'Kesehatan', 'Pendidikan', 'Ekonomi'] as $t) {
            Topik::firstOrCreate(['topik' => $t]);
        }
    }
}
