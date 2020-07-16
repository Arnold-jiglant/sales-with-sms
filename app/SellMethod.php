<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellMethod extends Model
{
    protected $fillable = [
        'method','description',
    ];
}
