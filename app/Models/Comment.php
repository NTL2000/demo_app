<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function User(){
    	return $this->belongsTo("App\Models\User","user_id","id");
    }
    public function Entry(){
    	return $this->belongsTo("App\Models\Entry","entry_id","id");
    }
    public function formattedCreatedDate() {
        if ($this->created_at->diffInDays() > 30) {
            return 'Created at ' . $this->created_at->toFormattedDateString();
        } else {
            return 'Created ' . $this->created_at->diffForHumans();
        }
    }
}
