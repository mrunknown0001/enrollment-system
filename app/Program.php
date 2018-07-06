<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
	protected $fillable = [
		'title', 'code', 'description', 'tuition_fee',
	];


	public function students()
	{
		return $this->hasMany('App\StudentInfo', 'program_id');
	}
}
