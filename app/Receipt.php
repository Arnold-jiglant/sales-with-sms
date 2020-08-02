<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'number', 'payment_type_code', 'customer_id', 'issuer',
    ];

    //RELATION
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_code', 'code');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'issuer');
    }

    //ATTRIBUTES
    public function getTotalAmountAttribute()
    {
        return $this->sales()->get()->sum(function ($sale) {
            return $sale->payedAmount;
        });
    }

    public function getCustomerNameAttribute()
    {
        return $this->customer != null ? $this->customer->name : 'NILL';
    }
}
