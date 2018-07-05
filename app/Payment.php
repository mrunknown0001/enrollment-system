<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	public function assessment()
	{
		return $this->belongsTo('App\Assessment', 'assessment_id');
	}

	public function student()
	{
		return $this->belongsTo('App\User', 'student_id');
	}
}
