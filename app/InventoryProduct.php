<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryProduct extends Model
{
    protected $fillable = [
        'product_id', 'inventory_id', 'quantity', 'cost', 'sellingPrice', 'discountRates', 'discount_type_id',
    ];
    protected $casts = [
        'discountRates' => 'json'
    ];
    protected $appends = [
        'buyingPrice', 'totalLossQuantity', 'totalLossAmount', 'remainingQty', 'hasDiscount'
    ];

    //RELATION
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function discountType()
    {
        return $this->belongsTo(DiscountType::class);
    }

    public function losses()
    {
        return $this->hasMany(Loss::class);
    }

    //ATTRIBUTES
    public function getNameAttribute()
    {
        return $this->product->name;
    }

    public function getHasSizeAttribute()
    {
        return $this->product->hasSize;
    }

    public function getHasDiscountAttribute()
    {
        return collect($this->discountRates)->count() > 0;
    }

    public function getBuyingPriceAttribute()
    {
        return floor($this->cost / $this->quantity);
    }

    public function getTotalLossQuantityAttribute()
    {
        return $this->losses()->sum('quantity');
    }

    public function getTotalLossAmountAttribute()
    {
        return $this->losses()->sum('amount');
    }

    public function getRemainingQtyAttribute()
    {
        return 0;//TODO calculate remain qty from sales
    }

}
