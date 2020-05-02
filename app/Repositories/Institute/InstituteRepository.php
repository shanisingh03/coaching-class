<?php

namespace App\Repositories\Institute;

use App\Models\Institute;
use App\Interfaces\Institute\InstituteRepositoryInterface;

class InstituteRepository implements InstituteRepositoryInterface
{
    /**
     * Return all Institute
     *  
     */ 
    public function all()
    {
        return Institute::all();
    }

    /**
     * Store Repository
     */
    public function store(array $institute)
    {
       return  Institute::create($institute);
    }

    /**
     * Update Repository
     */
    public function update(int $institute_id, array $institute)
    {
       return  Institute::find($institute_id)->update($institute);
    }

    /**
     * Get Details Of Institute
     */
    public function details(int $institute_id){
        return Institute::whereId($institute_id)
                    ->with('admins')
                    ->first();
    }
}