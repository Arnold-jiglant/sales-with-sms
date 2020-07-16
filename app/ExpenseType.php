<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseType extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description',
    ];

    //ATTRIBUTE
    public function getHasExpenses()
    {
        return $this->expenses()->count() > 0;
    }

    //RELATION
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
