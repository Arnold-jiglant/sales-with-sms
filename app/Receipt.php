<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'number', 'payment_type_code', 'customer_id', 'issuer',
    ];


    protected $appends = [
        'requiredPaymentAmount', 'payedAmount', 'debtAmount','incompletePayment'
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

    public function user()
    {
        return $this->belongsTo(User::class, 'issuer');
    }

    public function debtPayments()
    {
        return $this->hasMany(DebtPayment::class);
    }

    //ATTRIBUTES
    public function getRequiredPaymentAmountAttribute()
    {
        return $this->sales()->get()->sum(function ($sale) {
            return $sale->payedAmount;
        });
    }

    public function getPayedAmountAttribute()
    {
        if ($this->payment_type_code == PaymentType::$DEBT) {
            return $this->debtPayments()->get()->sum(function ($payment) {
                return $payment->amount;
            });
        } else {
            return $this->requiredPaymentAmount;
        }
    }

    public function getDebtAmountAttribute()
    {
        return $this->requiredPaymentAmount - $this->payedAmount;
    }

    public function getCustomerNameAttribute()
    {
        return $this->customer != null ? $this->customer->name : 'NILL';
    }

    public function getIncompletePaymentAttribute()
    {
        return $this->debtAmount >0;
    }
}
