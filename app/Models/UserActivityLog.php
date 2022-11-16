<?php

namespace App\Models;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserActivityLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','activity','description','date_time'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
  
}
