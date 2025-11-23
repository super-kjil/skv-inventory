<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name' => 'PHN',
                'description' => 'Phnom Penh',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'SHV',
                'description' => 'Sihanoukville',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
        ];

        Location::upsert(
            $locations,
            ['name'], // unique key
            ['description', 'updated_at']
        );
    }
}
