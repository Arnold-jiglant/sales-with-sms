<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'totalCost', 'expectedAmount', 'description', 'issuer', 'finished',
    ];
    protected $casts = [
        'finished' => 'boolean'
    ];
    protected $appends = [
        'progress',
    ];

    //SCOPE
    public function scopeUnfinished($query)
    {
        return Inventory::where('finished', false);
    }

    //RELATION
    public function inventoryProducts()
    {
        return $this->hasMany(InventoryProduct::class);
    }

    public function inventorySales()
    {
        return $this->hasMany(Sale::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'issuer');
    }

    //ATTRIBUTE
    public function getProgressAttribute()
    {
        return round($this->inventoryProducts()->get()->transform(function (InventoryProduct $inventoryProduct) {
            return 100 - $inventoryProduct->stockLevel;
        })->average(), 2);
    }

    public function getTotalLossAmountAttribute()
    {
        return $this->inventoryProducts()->get()->sum(function (InventoryProduct $invProduct) {
            return $invProduct->lossAmount;
        });
    }

    public function getTotalSalesAttribute()
    {
        return $this->inventoryProducts()->get()->sum(function (InventoryProduct $invProduct) {
            return $invProduct->saleAmount;
        });
    }
}
