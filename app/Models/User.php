<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use App\Models\UserType;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'age',
        'gender',
        'civil_status',
        'email',
        'password',
        'user_type_id',
        'profile_img',
        'barangay',
        'municipality',
        'province',
        'status',
        'date_recorded'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_type(){
        return $this->belongsTo(UserType::class);
    }

    public static function calculateAge($date_of_birth){
        date_default_timezone_set('Asia/Manila');
        $years = Carbon::parse($date_of_birth)->diff(Carbon::now())->format('%y years old');
        return $years;
    }
}
