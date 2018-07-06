<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	protected $fillable = [
		'title', 'code', 'description', 'curriculum',
	];

	public function students()
	{
		return $this->hasMany('App\StudentInfo', 'course_id');
	}
}
