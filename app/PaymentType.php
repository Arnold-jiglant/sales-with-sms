<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $primaryKey = 'code';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'name', 'description',
    ];
}
