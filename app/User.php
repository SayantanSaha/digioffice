<?php

namespace App;
use App\Models\Message;
use App\Models\Task;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname','lname','username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	public function messages()
    {
        return $this->hasMany('App\Models\Message','to');
    }
	
	public function tasks()
    {
        return $this->hasMany('App\Models\Task','created_by');
    }
}
