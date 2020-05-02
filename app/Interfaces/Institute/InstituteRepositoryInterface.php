<?php
namespace App\Interfaces\Institute;

interface InstituteRepositoryInterface
{
    /**
     * Get All Institutes
     */
    public function all();

    /**
     * Create Institute
     */
    public function store(array $institute);
    
    /**
     * Update Institute
     */
    public function update(int $institute_id, array $institute);
    
    /**
     * Get Details Of Institute
     */
    public function details(int $institute_id);
    

}