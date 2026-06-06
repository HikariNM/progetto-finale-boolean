<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneticTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genetic_tests')->insert([
            ['name' => 'MDR1', 'description' => 'Multi-Drug Resistance 1'],
            ['name' => 'CEA', 'description' => 'Collie Eye Anomaly'],
            ['name' => 'PRA', 'description' => 'Progressive Retinal Atrophy'],
            ['name' => 'DM', 'description' => 'Degenerative Myelopathy'],
            ['name' => 'HFS4', 'description' => 'Hereditary Cataracts'],
            ['name' => 'NCL', 'description' => 'Neuronal Ceroid Lipofuscinosis'],
            ['name' => 'MH', 'description' => 'Malignant Hyperthermia'],
        ]);
    }
}
