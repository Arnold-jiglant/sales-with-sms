<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    static public $VIEW_USERS = "US1";
    static public $ADD_USERS = "US2";
    static public $EDIT_USERS = "US3";
    static public $DELETE_USERS = "US4";
    static public $VIEW_CUSTOMERS = "CU1";
    static public $ADD_CUSTOMERS = "CU2";
    static public $EDIT_CUSTOMERS = "CU3";
    static public $DELETE_CUSTOMERS = "CU4";
    static public $VIEW_EXPENSES = "EX1";
    static public $ADD_EXPENSES = "EX2";
    static public $EDIT_EXPENSES = "EX3";
    static public $DELETE_EXPENSES = "EX4";
    static public $VIEW_INVENTORY = "IN1";
    static public $ADD_INVENTORY = "IN2";
    static public $EDIT_INVENTORY = "IN3";
    static public $DELETE_INVENTORY = "IN4";
    static public $VIEW_INCOMES = "INC1";
    static public $ADD_INCOME = "INC2";
    static public $EDIT_INCOME = "INC3";
    static public $DELETE_INCOME = "INC4";
    static public $SELL_PRODUCT = "SE1";
    static public $VIEW_REPORT = "RE1";

    protected $primaryKey = 'code';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'code','name',
    ];
}
