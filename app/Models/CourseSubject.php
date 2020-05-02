<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSubject extends Model
{
     /**
     * Fillable Object
     */
    protected $fillable = ['course_id','subject_id'];

    /**
     * Model Related Relationship
     */
    // protected $with = ['subject','course'];

    /**
     * Belongs To Institute
     */
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    /**
     * Belongs To Course
     */
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}
