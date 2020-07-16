<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'inventory_product_id', 'quantity', 'sellingPrice', 'buyingPrice', 'discount', 'receipt_id',
    ];
}
