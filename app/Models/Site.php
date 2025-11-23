<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'name',
        'location_id',
        'direction',

    ];

    public function customerUnits()
    {
        return $this->hasMany(CustomerUnit::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
