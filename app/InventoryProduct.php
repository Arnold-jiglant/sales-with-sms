<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryProduct extends Model
{
    protected $fillable = [
        'product_id', 'product_id', 'quantity', 'cost', 'sellingPrice', 'discountRates', 'discount_type_id',
    ];
    protected $casts = [
        'discountRates' => 'json'
    ];
}
