<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plot extends Model {

    public $timestamps = false;


    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function certificate() {
        return $this->belongsTo(Certificate::class, 'certificate_id');
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function usage() {
        return $this->belongsTo(Usage::class);
    }

    public function applications() {
        return $this->hasMany(Application::class, 'plot_id');
    }


    public function block() {
        return $this->belongsTo(Block::class, 'block_id');
    }

    public function wapi() {
        $block = $this->block; //->block_name;
        $street = $block->street;
        $ward = $street->ward;
        $district = $ward->district;

        return strtolower($block->block_name) . ', '
            .$street->street_name . ', '
            .$ward->ward_name . ', '
            .$district->district_name;
    }

    public function db_owner_name() {
        $owner = $this->owner;
        $res = $owner->firstname . ' ' .$owner->othernames;

        return $res;
    }



}
