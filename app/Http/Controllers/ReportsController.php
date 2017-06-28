<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('reports');
    }

    public function applications() {

        $res = DB::select("
SELECT plots.plot_number, COUNT(user_id) AS 'idadi'
FROM applications 
INNER JOIN plots ON (plots.id = applications.plot_id)
GROUP BY plots.plot_number
ORDER BY 'idadi' ");


        return $res;
    }



}
