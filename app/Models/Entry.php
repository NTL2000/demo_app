<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;
    public function Comment(){
    	return $this->hasMany("App\Models\Comment","entry_id","id");
    }
    public function User(){
    	return $this->belongsTo("App\Models\User","user_id","id");
    }
}
