<?php

namespace App\Models\System;

use App\Models\Information\Chat;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'real_name','state','phone','qq'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function seeds()
    {
        return $this->hasMany(Chat::class,'seeder_id');
    }

    public function receives()
    {
        return $this->hasMany(Chat::class,'receiver_id');
    }
}
