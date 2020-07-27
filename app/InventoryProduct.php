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

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    //ATTRIBUTES
    public function getNameAttribute()
    {
        return $this->product->name;
    }

    public function getNameFormatedAttribute()
    {
        return substr($this->product->name, 0, 16) . ' (' . $this->inventory->created_at->format('d-M-Y').')';
    }

    public function getHasSizeAttribute()
    {
        return $this->product->hasSize ? true : false;
    }

    public function getHasDiscountAttribute()
    {
        return collect($this->discountRates)->count() > 0;
    }

    public function getBuyingPriceAttribute()
    {
        return round($this->cost / $this->quantity, 4);
    }

    public function getTotalLossQuantityAttribute()
    {
        return $this->losses()->sum('quantity');
    }

    public function getTotalLossAmountAttribute()
    {
        return $this->losses()->sum('amount');
    }

    public function getTotalSaleQuantityAttribute()
    {
        return $this->sales()->sum('quantity');
    }

    public function getTotalSaleAmountAttribute()
    {
        return 0;  //TODO Calculate sale amount
    }

    public function getRemainingQtyAttribute()
    {
        return $this->quantity - ($this->totalSaleQuantity + $this->totalLossQuantity);
    }

}
