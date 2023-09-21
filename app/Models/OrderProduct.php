<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    protected $table = 'order_product';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];




    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('quantity') // Add additional pivot columns as needed
                    ->using(OrderProduct::class); // Custom pivot model
    }
}
