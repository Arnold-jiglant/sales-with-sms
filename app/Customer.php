<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name'];

    //RELATION
    public function receipts(){
        return $this->hasMany(Receipt::class);
    }

    //ATTRIBUTE
    public function getTotalSpentAttribute(){
        return $this->receipts()->get()->sum(function ($receipt){
            return $receipt->totalAmount;
        });
    }

    public function getVisitCountAttribute(){
        return $this->receipts()->count();
    }
}
