<?php

namespace App\Http\Controllers;

use App\Plot;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller {

    public function index() {
        return view('search');
    }

    public function search(Request $request) {

        $search_term = $request->get('query', '');

        if (sizeof($search_term) === 0) return back(); //no search query

        $search_term = '%' . $search_term . '%';

        $plots = Plot::where('plot_number', 'LIKE', $search_term)->get();


        $query = "SELECT * FROM (SELECT CONCAT(street_name,\" \", ward_name, \" \", district_name, \" \", region_name) AS 'location', street_id
                  FROM vw_locations) AS ta WHERE ta.location LIKE ?";

        $locations = DB::select($query, [$search_term]);

        return view('search')
            ->with('plots', $plots)
            ->with('locations', $locations)
            ->with('doneSearching', 1);
    }
}
