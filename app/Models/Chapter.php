<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    /**
     * Fillable Object
     */
    protected $fillable = ['institute_id','subject_id','course_id','chapter_name','status','image','marks_carry'];

     /**
     * Belongs To Institute
     */
    public function institute()
    {
        return $this->belongsTo('App\Models\Institute');
    }

    /**
     * Belongs TO Subjects
     */
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }
    /**
     * Belongs TO Course
     */
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}
