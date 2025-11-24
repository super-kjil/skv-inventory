<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CustomerUnit extends Model
{

    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
    }
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
