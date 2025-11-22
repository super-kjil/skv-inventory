<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'SKV',
            'The-Palm',
        ];

        foreach ($categories as $name) {
            Site::firstOrCreate(
                ['name' => $name],
            );
        }
    }
}
