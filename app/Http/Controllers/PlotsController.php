<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Location;
use App\Plot;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PlotsController extends Controller {

    public function __construct() {
        //$this->middleware('auth'); //no need of login to view plots for example
    }


    public function add($latitude, $longitude) {
        $users = User::select(DB::raw('CONCAT(firstname, " ", othernames) as name, id'))->get()->toArray();
        dd($users);

        return view('plot-add')
            ->with('users', $users)
            ->with('lat', $latitude)
            ->with('lng', $longitude)
            ->with('success', false)
            ->with('fresh', true);
    }

    public function view($id) {
        $plot = Plot::find($id);
        $cert = $plot->certificate;
        $wapi = $plot->wapi();

        return view('plot-details')
            ->with('plot', $plot)
            ->with('cert', $cert)
            ->with('wapi', $wapi);
    }


    public function new_plot(Request $request) {

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $path = $request->image->store('images');

            $this->addPlotToDb($request, $path);

        } else {
            return back()
                ->with('success', false)
                ->with('fresh', false)
                ->with('error', 'Request has no image, or it was not uploaded successfully');
        }

        return back()->with('success', true)->with('fresh', false);
    }



    public function all() {
        return Plot::all();
    }

    private function addPlotToDb($request, $path) {

        $certificate = new Certificate();
        $certificate->path = $path;
        $certificate->save();

        $plot = new Plot();
        $plot->owner_name = $request->owner;
        $plot->status_id = random_int(1, 3);
        $plot->block_id = random_int(1, 500);
        $plot->plot_number = random_int(1, 100);
        $plot->latitude = $request->lat;
        $plot->longitude = $request->lng;
        $plot->certificate_id = $certificate->id;
        $plot->save();

    }

}
