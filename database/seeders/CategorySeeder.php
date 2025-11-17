<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(['name' => 'Access Point'], ['active' => true]);
        Category::firstOrCreate(['name' => 'ONU'], ['active' => true]);
        Category::firstOrCreate(['name' => 'Patch Cord'], ['active' => true]);
        Category::firstOrCreate(['name' => 'Equipment'], ['active' => true]);
        Category::firstOrCreate(['name' => 'TV-BOX'], ['active' => true]);

    }
}
