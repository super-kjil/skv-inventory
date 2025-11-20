<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Access Point',
            'ONU',
            'Patch Cord',
            'Equipment',
            'TV-BOX',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(
                ['name' => $name],
                ['active' => true]
            );
        }
    }
}
