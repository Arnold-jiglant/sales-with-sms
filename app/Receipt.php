<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'number', 'payment_type_code', 'customer_id', 'issuer',
    ];

    //RELATION
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
