<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'expense_type_id', 'amount', 'description', 'issuer',
    ];

    //RELATION
    public function type()
    {
        return $this->belongsTo(ExpenseType::class,'expense_type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'issuer');
    }
}
