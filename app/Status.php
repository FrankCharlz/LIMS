<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{


    protected $table  = 'statusinfo';
    protected  $primaryKey = 'status_id';

    public $timestamps = false;


}
