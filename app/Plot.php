<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{

    protected $table  = 'plot';
    protected  $primaryKey = 'plot_id';

    public $timestamps = false;
}
