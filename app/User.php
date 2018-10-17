<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'gender', 'student_number', 'mobile_number', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function info()
    {
        return $this->hasOne('App\StudentInfo', 'student_id');
    }


    public function enrollment_status()
    {
        return $this->hasMany('App\EnrollmentStatus', 'student_id');
    }


    public function assessment()
    {
        return $this->hasMany('App\Assessment', 'student_id');
    }

    public function avatar()
    {
        return $this->hasOne('App\Avatar', 'student_id');
    }

    public function balance()
    {
        return $this->hasOne('App\Balance', 'student_id');
    }


}
