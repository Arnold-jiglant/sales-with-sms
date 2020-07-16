<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'number','payment_type_id','customer_id','issuer',
    ];
}
