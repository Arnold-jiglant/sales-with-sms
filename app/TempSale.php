<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempSale extends Model
{
    protected $fillable = [
        'inventory_product_id', 'quantity', 'sellingPrice', 'buyingPrice', 'discount', 'name', 'total',
    ];

    //RELATION
    public function inventoryProduct()
    {
        return $this->belongsTo(InventoryProduct::class);
    }
}
