<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    public function admin()
    {
    	return $this->belongsTo('App\Admin', 'user_id');
    }

    public function registrar()
    {
    	return $this->belongsTo('App\Registrar', 'user_id');
    }

    public function cashier()
    {
    	return $this->belongsTo('App\Cashier', 'user_id');
    }

    public function faculty()
    {
    	return $this->belongsTo('App\Faculty', 'user_id');
    }

    public function student()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    
    
}
