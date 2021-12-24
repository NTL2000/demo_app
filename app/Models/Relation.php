<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;
    public function User(){
    	return $this->belongsTo("App\Models\User","user_id","id");
    }
    public function UserFollowing(){
    	return $this->belongsTo("App\Models\User","following_user_id","id");
    }
}
