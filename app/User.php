<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username','firstname','othernames', 'email', 'password', 'phone', 'type'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function applications() {
        return $this->hasMany(Application::class, 'user_id');
    }


    public function plots() {
        return $this->hasMany(Plot::class, 'owner_id');
    }

    public function role() {
        return $this->hasOne(Role::class, 'role_id');
    }

    public function name() {
        return ($this->firstname . ' ' . $this->othernames);
    }

    public function isApplyingFor($plotId) {
        $app = Application::where('plot_id', '=', $plotId)
            ->where('user_id', $this->id)
            ->where('status', 0)
            ->select('id', 'created_at')
            ->limit(1)
            ->get()
            ->toArray();

       return $app;

    }

    public function owns($plot_id) {
        $x =  sizeof(Plot::where('id', $plot_id)->where('owner_id', $this->id)->get()->toArray());
        return $x;
    }

}
