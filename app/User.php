<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
    protected $fillable = [
        'fname', 'lname', 'email', 'password', 'role_id', 'active'
    ];
    protected $hidden = [
        'password'
    ];
    protected $casts = [
        'active' => 'boolean',
    ];

    //ATTRIBUTE
    public function getNameAttribute()
    {
        return ucfirst($this->fname) . ' ' . ucfirst($this->lname);
    }
    //SCOPE
    //RELATION
}
