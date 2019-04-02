<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollmentStatus extends Model
{
    public function course()
    {
    	return $this->belongsTo('App\Course', 'course_id');	
    }


    public function program()
    {
    	return $this->belongsTo('App\Program', 'program_id');
    }


    
}
