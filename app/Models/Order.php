<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;

class Order extends Model
{
    protected $fillable = [
        'product_id',
        'support_person',
        'customer_unit',
        'date',
        'qty',
        'status',
        'commands',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
