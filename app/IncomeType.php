<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeType extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description',
    ];

    protected $appends = [
        'hasIncomes'
    ];

    //ATTRIBUTE
    public function getHasIncomesAttribute()
    {
        return $this->incomes()->count() > 0;
    }

    //RELATION
    public function incomes()
    {
        return $this->hasMany(Income::class);
    }
}
