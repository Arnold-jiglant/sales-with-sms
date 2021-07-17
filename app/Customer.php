<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];


    //RELATION
    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    public function debtNotifications()
    {
        return $this->hasMany(DebtNotification::class);
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

    public function getReceiptsWithDebtAttribute()
    {
        return $this->receipts()->get()->filter(function (Receipt $receipt) {
            return $receipt->incompletePayment;
        });
    }

    public function getFormattedPhoneNumberAttribute()
    {
        return str_replace('+', '', $this->phone_number);
    }

    public function getDebtMessageAttribute()
    {

        $receipts = "";
        $this->receiptsWithDebt->each(function ($receipt) use (&$receipts) {
            $receipts = $receipts . $receipt->number . " kiasi " . number_format($receipt->debtAmount) . ",\r\n";
        });
        return "Dear " . $this->name . ",\r\n" .
            "You are being reminded to pay your debt of receipt(s) as follows:-\r\n" .
            "$receipts \r\n" .

            "Total " . number_format($this->totalDebt) . "/= \r\n" .
            "Some Retail Shop";
    }

    public function getLastDebtNotificationTimeAttribute()
    {
        if ($this->debtNotifications()->count() > 0) {
            return $this->debtNotifications()->latest()->first()->created_at->diffForHumans();
        } else {
            return "";
        }
    }
}
