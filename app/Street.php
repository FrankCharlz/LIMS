<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{


    protected $table  = 'street';
    protected  $primaryKey = 'street_id';

    public $timestamps = false;
}
