<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DebtPayment extends Model
{
    protected $fillable = [
        'receipt_id', 'amount', 'issuer'
    ];

    //RELATION
    public function user()
    {
        return $this->belongsTo(User::class, 'issuer');
    }
}
