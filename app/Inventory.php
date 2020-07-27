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
        return 20;  //TODO calculate progress from sales
    }
}
