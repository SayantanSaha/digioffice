<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
	public function scopeUnread($query)
    {
        return $query->where('read', '=', 0);
    }
}
