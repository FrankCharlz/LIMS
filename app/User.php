<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username','firstname','othernames', 'email', 'password', 'phone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function applications() {
        return $this->hasMany(Application::class, 'user_id');
    }


    public function plots() {
        return $this->hasMany(Plot::class, 'user_id');
    }

    public function role() {
        return $this->hasOne(Role::class, 'role_id');
    }


}
