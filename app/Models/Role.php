<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //Fillable Object
    protected $fillable = ['name','status'];

    //Has Many users
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
