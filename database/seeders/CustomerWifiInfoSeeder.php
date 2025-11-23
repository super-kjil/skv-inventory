<?php

namespace Database\Seeders;

use App\Models\WifiInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerWifiInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wifiinfo = [
            [
                'customer_unit_id' => 1,
                'ssid' => '17F-A3',
                'password' => 'Skyvilla17FA3',
                'product_id' => 1,
                'mgmt_ip' => '10.10.17.1',
                'mgmt_user' => 'admin',
                'mgmt_password' => '123qwe!@#',
                'status' => 'Active',
                'remark' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'customer_unit_id' => 2,
                'ssid' => '28F-B3',
                'password' => 'Skyvilla28FB3',
                'product_id' => 1,
                'mgmt_ip' => '10.10.28.1',
                'mgmt_user' => 'admin',
                'mgmt_password' => '123qwe!@#',
                'status' => 'Active',
                'remark' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],

        ];

        WifiInfo::upsert(
            $wifiinfo,
            ['customer_unit_id'], // unique key
            ['ssid', 'password', 'product_id', 'mgmt_ip', 'mgmt_user', 'mgmt_password', 'status', 'remark', 'updated_at']
        );
    }
}
