<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model {

    protected $table  = 'ward';
    protected  $primaryKey = 'ward_id';

    public $timestamps = false;


    public function district() {
        return $this->belongsTo(District::class, 'district_id');
    }
}
