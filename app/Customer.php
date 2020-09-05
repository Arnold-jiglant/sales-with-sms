<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name'];

    //RELATION
    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    //ATTRIBUTE
    public function getTotalSpentAttribute()
    {
        return $this->receipts()->get()->sum(function ($receipt) {
            return $receipt->payedAmount;
        });
    }

    public function getVisitCountAttribute()
    {
        return $this->receipts()->count();
    }

    public function getTotalDebtAttribute()
    {
        $debt = $this->receipts()->get()->sum(function ($receipt) {
            return $receipt->debtAmount;
        });
        return $debt <= 0 ? 0 : $debt;
    }
}
