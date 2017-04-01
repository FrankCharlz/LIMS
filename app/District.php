<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    protected $table  = 'district';
    protected  $primaryKey = 'district_id';

    public $timestamps = false;
}
