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
        'customer_unit_id',
        'date',
        'qty',
        'status',
        'remark',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function customerUnit(): BelongsTo
    {
        return $this->belongsTo(CustomerUnit::class);
    }
}
