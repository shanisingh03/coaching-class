<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    /**
     * Fillable Object
     */
    protected $fillable = ['institute_id','subject_id','chapter_name','status','image','marks_carry'];
}
