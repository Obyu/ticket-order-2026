<?php

namespace Database\Seeders;

use App\Models\Studio;
use Illuminate\Database\Seeder;

class StudioSeeder extends Seeder

{
    public function run(): void
    {
        Studio::firstOrCreate([
            'name' => 'Studio 1',
        ], [
            'capacity' => 100,
        ]);

        Studio::firstOrCreate([
            'name' => 'Studio 2',
        ], [
            'capacity' => 100,
        ]);
    }
}