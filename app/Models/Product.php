<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    
    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
    
    protected $fillable = [
        'name', 
        'commands', 
        'image', 
        'qty', 
        'instock_date'
    ];
    
    protected $casts = [
        'image' => 'array',
    ];
    

    
}
