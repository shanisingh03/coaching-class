<?php
namespace App\Interfaces\User;

interface UserRepositoryInterface
{
    /**
     * Get All User
     */
    public function all();
    
    /**
     * Get Admins
     */
    public function getAdmins();

}