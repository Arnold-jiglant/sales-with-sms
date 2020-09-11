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
        'fname', 'lname', 'email', 'password', 'role_id', 'language_id', 'active'
    ];
    protected $hidden = [
        'password'
    ];
    protected $casts = [
        'active' => 'boolean',
    ];

    protected $appends = [
        'languageName'
    ];

    //ATTRIBUTE
    public function getNameAttribute()
    {
        return ucfirst($this->fname) . ' ' . ucfirst($this->lname);
    }

    //SCOPE
    public function getIsManagerAttribute()
    {
        return $this->role->name == 'Manager';
    }

    //ATTRIBUTE
    public function getLocaleNameAttribute(){
        return $this->language->locale;
    }

    //RELATION
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
