<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = [
        'name', 'value', 'description',
    ];

    //ATTRIBUTE
    public function scopeSellMethod($q){
        return Configuration::where('name','sellMethod')->first()->value;
    }
}
