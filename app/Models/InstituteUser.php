<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstituteUser extends Model
{
    //Fillable Object
    protected $fillable = ['institute_id','user_id','status','role_id'];

    //With Relationship
    protected $with = ['institute','user'];

    // Belongs To Institute
    public function institute()
    {
        return $this->belongsTo('App\Models\Institute');
    }
    
    //Belongs to User
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    //Belongs to Role
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

}
