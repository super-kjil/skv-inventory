<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerUnit extends Model
{
    protected $fillable = [
        'unit_name',
        'floor',
        'site_id',
        'status',
        'remark',
    ];

    public function site() 
    {
        return $this->belongsTo(Site::class);
    }

    public function wifiInfos()
    {
        return $this->hasMany(WifiInfo::class);
    }
}
