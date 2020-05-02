<?php

namespace App\Repositories\User;

use App\User;
use App\Interfaces\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Return all user
     *  */ 
    public function all()
    {
        return User::all();
    }

    /**
     * Return only Admins
     */
    public function getAdmins()
    {
        return User::where('role_id',2)->with('institute')->get();
    }

}