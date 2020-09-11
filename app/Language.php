<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Language extends Model
{
    protected $fillable = [
        'name', 'locale'
    ];
}
