<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'expense_type_id', 'amount', 'description', 'issuer',
    ];
}
