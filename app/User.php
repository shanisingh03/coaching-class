<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','mobile', 'email', 'password','role_id','email_verified_at','is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Add With Data
     */
    protected $with = ['role'];

    /**
     * Full name attribute
     */
    public function getFullNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }

    /**
     * Every user belongs to a role
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function institute()
    {
        return $this->hasOne('App\Models\InstituteUser');
    }
}
