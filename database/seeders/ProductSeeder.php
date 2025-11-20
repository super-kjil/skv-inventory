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
                'image' => 'https://computerarenakh.com/image/catalog/02.DIY%20MATERIAL%202023/Router-Inalambrico-Archer-C24-7.jpg',
                'qty' => 10,
                'instock_date' => now(),
            ],
            [
                'name' => 'TP-Link Deco Mesh',
                'category_id' => 1,
                'remark' => null,
                'image' => 'https://m.media-amazon.com/images/I/71Y3pdvaHjL._AC_SL1500_.jpg',
                'qty' => 10,
                'instock_date' => now(),
            ],
            [
                'name' => 'RG-EW3200GX PRO',
                'category_id' => 1,
                'remark' => null,
                'image' => 'https://www.techgear.com.hk/cdn/shop/files/Frame_Ruijie_EW3200GX-Pro_v2.jpg',
                'qty' => 20,
                'instock_date' => now(),
            ],
            [
                'name' => 'Ruijie AX3000',
                'category_id' => 1,
                'remark' => null,
                'image' => 'https://ptcl.com.pk/images/products/RG-EW3000GX.jpg',
                'qty' => 20,
                'instock_date' => now(),
            ],
            [
                'name' => 'BDCOM GP1702-4G Dual Band 4-port',
                'category_id' => 2,
                'remark' => null,
                'image' => 'https://img.drz.lazcdn.com/static/bd/p/e1925e9693f6b9e09602330f43e66acf.jpg_720x720q80.jpg_.webp',
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