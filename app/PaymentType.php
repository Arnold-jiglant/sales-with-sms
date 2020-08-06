<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    static public $CASH = 'CSH';
    static public $CRD = 'CRD';
    static public $DEBT = 'DBT';

    protected $primaryKey = 'code';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'name', 'description',
    ];
}
