<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    

    public function course()
    {
    	return $this->belongsTo('App\Course', 'course_id');
    }


    public function subjects()
    {
    	return $this->hasOne('App\CurriculumSubject', 'curriculum_id');
    }
}
