<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'income_type_id', 'amount', 'description', 'issuer',
    ];

    //RELATION
    public function type()
    {
        return $this->belongsTo(IncomeType::class,'income_type_id');
    }
}
