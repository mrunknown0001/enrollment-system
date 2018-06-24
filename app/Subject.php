<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	protected $fillable = [
		'title', 'code', 'description', 'units', 'year_level',
	];
}
