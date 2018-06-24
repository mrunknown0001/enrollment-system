<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
	protected $fillable = [
		'title', 'code', 'description', 'tuition_fee',
	];
}
