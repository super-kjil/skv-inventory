<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WifiInfo extends Model
{
    protected $fillable = [
        'customer_unit_id',
        'ssid',
        'password',
        'product_id',
        'mgmt_ip',
        'wifi_user',
        'wifi_password',
        'status',
        'remark',
    ];

    public function customerUnit()
    {
        return $this->belongsTo(CustomerUnit::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
