<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model {



    public function applicantsNames() {
        $query = "SELECT CONCAT(firstname, ' ', othernames) AS 'name' 
                    FROM users
                    INNER JOIN applications ON (applications.user_id = users.id)
                    WHERE applications.id = ?";

    }

    public function applier() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
