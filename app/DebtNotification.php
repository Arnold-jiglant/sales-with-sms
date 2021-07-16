<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DebtNotification extends Model
{

    public static $SENT="sent";
    public static $DELIVERED="delivered";
    public static $PENDING="pending";
    public static $FAILED="failed";

    protected $guarded = [];


    //relation
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
