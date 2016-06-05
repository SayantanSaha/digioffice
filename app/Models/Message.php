<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
	public function scopeUnread($query)
    {
        return $query->where('read', '=', 0);
    }
	public function frm()
	{
		return $this->belongsTo('App\User','from');
	}
}
