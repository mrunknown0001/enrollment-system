<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Faculty extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'gender', 'id_number', 'mobile_number', 'password',
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
        return $this->hasOne('App\FacultyInfo', 'faculty_id');
    }

    public function program_assignments()
    {
        return $this->hasMany('App\ProgramAssignment', 'faculty_id');
    }

    public function subject_assignments()
    {
        return $this->hasMany('App\SubjectAssignment', 'faculty_id');
    }
}
