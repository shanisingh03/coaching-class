<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Institute extends Model
{
    //Fillable Object
    protected $fillable = ['name','tag_line','email','mobile_no','website','logo','registered_at','address'];

    // Institute Has Many users
    public function users()
    {
        return $this->hasMany('App\Models\InstituteUser','institute_id','id');
    }

    //Admins
    public function admins()
    {
        return $this->users()->where('role_id',2);
    }
}
