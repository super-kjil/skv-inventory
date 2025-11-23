<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'TP-Link AC-750',
                'category_id' => 1,
                'remark' => 'VN Language',
                'image' => null,
                'qty' => 10,
                'instock_date' => now(),
            ],
            [
                'name' => 'TP-Link Deco Mesh',
                'category_id' => 1,
                'remark' => null,
                'image' => null,
                'qty' => 10,
                'instock_date' => now(),
            ],
            [
                'name' => 'RG-EW3200GX PRO',
                'category_id' => 1,
                'remark' => null,
                'image' => null,
                'qty' => 20,
                'instock_date' => now(),
            ],
            [
                'name' => 'Ruijie AX3000',
                'category_id' => 1,
                'remark' => null,
                'image' => null,
                'qty' => 20,
                'instock_date' => now(),
            ],
            [
                'name' => 'BDCOM GP1702-4G Dual Band 4-port',
                'category_id' => 2,
                'remark' => null,
                'image' => null,
                'qty' => 20,
                'instock_date' => now(),
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }
}