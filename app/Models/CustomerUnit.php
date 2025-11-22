<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerUnit extends Model
{
    protected $fillable = [
        'unit_name',
        'customer_type',
        'site_id',
        'status',
        'remark',
        'customer_name',
        'customer_id',
        'customer_tel',
    ];

    public function site() 
    {
        return $this->belongsTo(Site::class);
    }

    public function wifiInfomation()
    {
        return $this->hasMany(WifiInfo::class);
    }
}
