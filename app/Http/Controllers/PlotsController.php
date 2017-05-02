<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Location;
use App\Plot;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PlotsController extends Controller {

    public function __construct() {
        //$this->middleware('auth'); //no need of login to view plots for example
    }


    public function add($latitude, $longitude) {
        $users = User::select('id', 'firstname', 'othernames')
            ->orderBy('firstname', 'asc')
            ->get()
            ->toArray();

        return view('plot-add')
            ->with('users', $users)
            ->with('lat', $latitude)
            ->with('lng', $longitude);
            //->with('addError', true)
            //->with('error', 'An error occurred while adding plot');
    }

    public function plotsForUser() {
        $plots = Plot::where('owner_id', Auth::id())->get();
        return view('plots')->with('plots', $plots);
    }

    public function listOnSale() {
        $plots = Plot::where('status_id', 1)->get();
        return view('plots-on-sale')->with('plots', $plots);
    }


    public function view($id) {
        $plot = Plot::find($id);
        $cert = $plot->certificate;
        $wapi = $plot->wapi();

        return view('plot-details')
            ->with('plot', $plot)
            ->with('cert', $cert)
            //->with('justAdded', true)
            ->with('wapi', $wapi);
    }


    public function new_plot(Request $request) {

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $path = $request->image->store('images');
            $addedPlot = $this->addPlotToDb($request, $path);

        } else {
            return back()
                ->with('success', false)
                ->with('error', 'Request has no image, or it was not uploaded successfully');
        }

        return redirect('/plots/view/'.$addedPlot->id)->with('justAdded', true);
    }


    public function all() {
        return Plot::all();
    }

    private function addPlotToDb($request, $path) {

        $certificate = new Certificate();
        $certificate->path = $path;
        $certificate->save();

        $plot = new Plot();
        $plot->owner_id = $request->owner;
        $plot->area = $request->area;
        $plot->status_id = random_int(1, 3);
        $plot->block_id = random_int(1, 500);
        $plot->plot_number = random_int(1, 100);
        $plot->latitude = $request->lat;
        $plot->longitude = $request->lng;
        $plot->certificate_id = $certificate->id;
        $plot->save();

        return $plot;

    }

}
