<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model {


    public function author() {
        return $this->belongsTo(User::class, 'creator_id');
    }


    public function authorFullName() {
        $author = $this->author;
        //dd($author);
        return $author['firstname'] . ' ' .$author['othernames'];
    }
}
