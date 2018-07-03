<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
	protected $fillable = [
		'program_id', 'course_id', 'subject_ids', 'term', 'level',
	];


    public function course()
    {
    	return $this->belongsTo('App\Course', 'course_id');	
    }


    public function program()
    {
    	return $this->belongsTo('App\Program', 'program_id');
    }
}
