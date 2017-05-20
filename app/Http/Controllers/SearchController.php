<?php

namespace App\Http\Controllers;

use App\Plot;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function index() {
        return view('search');
    }

    public function search(Request $request) {

        $search_term = $request->get('query', '');

        if (sizeof($search_term) === 0) return back(); //no search query

        $search_term = '%' . $search_term . '%';

        $plots = Plot::where('plot_number', 'LIKE', $search_term)->get();

        $users = User::where('firstname', 'LIKE', $search_term)
            ->where('othernames', 'LIKE', $search_term)
            ->get();

        $results = [$plots, $users];

        dd($results);

        return view('search');
    }
}
