<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{


    protected $table  = 'street';
    protected  $primaryKey = 'street_id';

    public $timestamps = false;

    public function ward() {
        return $this->belongsTo(Ward::class, 'ward_id');
    }

    public function blocks() {
        return $this->hasMany(Block::class, 'street_id');
    }
}
