<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyInfo extends Model
{
	protected $fillable = [
		'student_id', 'date_of_birth', 'place_of_birth', 'address', 'nationality', 
	];
}
