<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
	protected $fillable = [
		'program_id', 'course_id', 'subject_ids', 'term', 'level',
	];
}
