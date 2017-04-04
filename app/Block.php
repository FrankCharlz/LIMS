<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{

    protected $table  = 'block';
    protected  $primaryKey = 'block_id';

    public $timestamps = false;

    public function street() {
        return $this->belongsTo(Street::class, 'street_id');
    }
}
