<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    //protected $dates = ['created_at'];

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
    /**
     * @var mixed
     */

    public function profileImage()
    {
        $imagePath = ($this->profile_image) ?  $this->profile_image : 'uploads/F8mTZlWZ8POfD1ShOqOSqy4cAeUsnUnDSKMSroio.png';
        return '/storage/' . $imagePath;
    }

    public function devices()
    {
        return $this->hasMany(Device::class, 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'comment');
    }
    //public function roles()
    //{
    //  return $this->belongsToMany(Role::class);
    //}

    public function hasRole($role)
    {
       return $this->role == $role;
    }
}
