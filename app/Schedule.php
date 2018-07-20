<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function subject()
    {
    	return $this->belongsTo('App\Subject', 'subject_id');
    }

    public function room()
    {
    	return $this->belongsTo('App\Room', 'room_id');
    }
}
