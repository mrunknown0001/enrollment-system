<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	protected $fillable = [
		'title', 'code', 'description', 'units', 'year_level',
	];

	public function prereq()
	{
		return $this->belongsto('App\Subject', 'prerequisites', 'id');
	}
}
