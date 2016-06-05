<?php

namespace App\Models;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
class Task extends Model
{
    //
	//protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	//protected $dateFormat = 'd/m/Y';
	/*public function getEnddateAttribute($value)
    {
        return ucfirst($value);
    }*/
	public function scopeOpen($query)
    {
        return $query->where('closed', '=', 0);
    }
	public function scopeClosed($query)
    {
        return $query->where('closed', '=', 1);
    }
	public function scopeUrgent($query)
    {
        return $query->where('closed', '=', 0)->where('enddate','=','curdate()');
    }
	public function user()
	{
		return $this->belongsTo('App\User','created_by');
	}
	public function comments()
	{
		return $this->hasMany('App\Models\Comment');
	}
}
