<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loss extends Model
{
    protected $fillable = [
        'inventory_product_id', 'quantity', 'amount', 'description',
    ];

    //RELATION
    public function invProduct()
    {
        return $this->belongsTo(InventoryProduct::class,'inventory_product_id');
    }
}
