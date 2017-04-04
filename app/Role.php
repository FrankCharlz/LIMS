<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{


    protected $table  = 'role';
    protected  $primaryKey = 'role_id';

    public $timestamps = false;

    public function users() {
        return $this->hasMany(User::class, 'role_id');
    }
}
