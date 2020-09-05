<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    //RELATION
    //role permissions
    public function permissions()
    {
        return $this->hasMany(RolePermission::class);
    }

    //role users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
