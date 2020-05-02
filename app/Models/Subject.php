<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /**
     * Fillable Object
     */
    protected $fillable = ['institute_id','subject_name','status','image'];

    /**
     * Model Related Relationship
     */
    // protected $with = ['institute'];


    /**
     * Belongs To Institute
     */
    public function institute()
    {
        return $this->belongsTo('App\Models\Institute');
    }

    /**
     * Belongs To Course
     */
    public function courses()
    {
        return $this->hasMany('App\Models\CourseSubject');
    }
}
