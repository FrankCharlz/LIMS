<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{

    protected $table  = 'certificate';
    protected  $primaryKey = 'certificate_id';

    public $timestamps = false;
}
