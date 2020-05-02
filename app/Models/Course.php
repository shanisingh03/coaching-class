<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * Fillable Object
     */
    protected $fillable = ['course_name','institute_id','status','image'];

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
     * Has Many Subjects
     */
    public function subjects()
    {
        return $this->hasMany('App\Models\CourseSubject');
    }
}
