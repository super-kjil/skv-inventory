<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Product;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        if ($order->product && $order->qty) {
            // Ensure qty is positive integer
            $decrementBy = max(0, (int) $order->qty);
            if ($decrementBy > 0) {
                $order->product->decrement('qty', $decrementBy);
            }
        }
    }

    public function deleted(Order $order)
    {
        Product::where('id', $order->product_id)
            ->increment('qty', $order->qty);
    }

    public function updated(Order $order)
    {
        if ($order->wasChanged('qty')) {
            $oldQty = $order->getOriginal('qty');
            $diff = $oldQty - $order->qty;

            // If qty reduced → return stock
            if ($diff > 0) {
                Product::where('id', $order->product_id)->increment('qty', $diff);
            }

            // If qty increased → decrease stock
            if ($diff < 0) {
                Product::where('id', $order->product_id)->decrement('qty', abs($diff));
            }
        }
    }
}
