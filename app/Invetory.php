<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invetory extends Model
{
    protected $fillable = [
        'totalCost', 'expectedAmount', 'description', 'issuer','finished',
    ];
    protected $casts = [
        'finished'=>'boolean'
    ];
}
