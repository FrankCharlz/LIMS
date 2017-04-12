<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Location;
use App\Plot;
use Illuminate\Http\Request;


class PlotsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }


    public function add($latitude, $longitude) {
        return view('plot-add')
            ->with('lat', $latitude)
            ->with('lng', $longitude)
            ->with('success', false)
            ->with('fresh', true);
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
