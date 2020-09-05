<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'inventory_product_id', 'quantity', 'sellingPrice', 'discount', 'receipt_id',
    ];

    //RELATION
    public function inventoryProduct()
    {
        return $this->belongsTo(InventoryProduct::class);
    }

    //ATTRIBUTE
    public function getAfterDiscountPriceAttribute()
    {
        return ($this->sellingPrice - $this->discount);
    }

    public function getPayedAmountAttribute()
    {
        return $this->quantity * $this->afterDiscountPrice;
    }

    public function getProductNameAttribute()
    {
        return $this->inventoryProduct->name;
    }
}
