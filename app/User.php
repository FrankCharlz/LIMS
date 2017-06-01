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
        return $this->hasMany(Plot::class, 'owner_id');
    }

    public function role() {
        return $this->hasOne(Role::class, 'role_id');
    }

    public function hasAppliedFor($plot) {
        $app = Application::where('plot_id', '=', $plot)
            ->where('user_id', $this->id)
            ->where('status', 0)
            ->select('id', 'created_at')
            ->limit(1);

        //print_r($app->toSql());

        $app = $app->get()->toArray(); //todo: do this the model way

        //print_r($plot);
        //print_r($this->id);
        //dd($app);

        return $app;

    }

}
