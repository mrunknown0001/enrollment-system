<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
	protected $fillable = [
		'student_id', 'date_of_birth', 'place_of_birth', 'address', 'nationality', 'academic_program', 'school_year_admitted', 'category', 'school_last_attended', 'date_graduated', 'mop_id', 
	];
}
