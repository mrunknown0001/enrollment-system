<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollmentStatus extends Model
{
    public function course()
    {
    	return $this->hasOne('App\Course', 'course_id');	
    }


    public function program()
    {
    	return $this->hasOne('App\Program', 'program_id');
    }
}
