<?php

namespace Database\Seeders;

use App\Models\CustomerUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customerInfo = [
            [
                'unit_name' => '17F-A3',
                'customer_type' => 'Tenant',
                'site_id'   => 1,
                'status' => 'Active',
                'remark' => null,
                'customer_name' => null,
                'customer_id' => '1119GDAR',
                'customer_tel' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'unit_name' => '28F-B3',
                'customer_type' => 'Tenant',
                'site_id'   => 1,
                'status' => 'Active',
                'remark' => null,
                'customer_name' => null,
                'customer_id' => '1249GDAR',
                'customer_tel' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
        ];

        CustomerUnit::upsert(
            $customerInfo,
            ['unit_name'],
            ['customer_type', 'site_id', 'status', 'remark', 'customer_name', 'customer_id', 'customer_tel', 'updated_at']
        );
    }
}
