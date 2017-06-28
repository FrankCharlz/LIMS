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


    public function addScratch() {
        $users = User::select('id', 'firstname', 'othernames')
            ->orderBy('firstname', 'asc')
            ->get()
            ->toArray();

        $statuses = DB::table('statusinfo')->select('id', 'name')->get();
        $usages = DB::table('land_usage')->select('id', 'name')->get();

        return view('plot-add')
            ->with('users', $users)
            ->with('statuses', $statuses)
            ->with('usages', $usages);

    }

    public function addBatch() {
        return view('plot-add-batch');
    }

    public function add($latitude, $longitude) {
        $users = User::select('id', 'firstname', 'othernames')
            ->orderBy('firstname', 'asc')
            ->get()
            ->toArray();

        $statuses = DB::table('statusinfo')->select('id', 'name')->get();
        $usages = DB::table('land_usage')->select('id', 'name')->get();


        return view('plot-add')
            ->with('users', $users)
            ->with('statuses', $statuses)
            ->with('usages', $usages)
            ->with('lat', $latitude)
            ->with('lng', $longitude);

    }

    public function edit($id) {
        $users = User::select('id', 'firstname', 'othernames')
            ->orderBy('firstname', 'asc')
            ->get()
            ->toArray();

        $plot = Plot::find($id);

        return view('plot-edit')
            ->with('plot', $plot)
            ->with('users', $users);
    }

    public function removeOnSale($pid) {
        $plot = Plot::find($pid);
        $plot->status_id = 0;
        $plot->save();

        //cancel all --PENDING applications on this plot
        DB::table('applications')
            ->where('plot_id', $pid)
            ->where('status', 0)
            ->update(['status' => 3]);
    }

    public function putOnSale($pid) {
        $plot = Plot::find($pid);
        $plot->status_id = 1;
        $plot->save();
    }


    public function manage() {
        $plots = Plot::all();
        return view('plots')->with('plots', $plots);
    }


    public function plotsForUser() {
        $plots = Plot::where('owner_id', Auth::id())->get();
        return view('plots')->with('plots', $plots);
    }

    public function listOnSale() {
        $plots = Plot::where('status_id', 1)->get();
        return view('plots-on-sale')->with('plots', $plots);
    }

    public function buy($id) {
        $plot = Plot::find($id);
        return view('plot-buy')->with('plot', $plot);
    }


    public function view($id) {
        $plot = Plot::find($id);
        $wapi = $plot->wapi();

        return view('plot-details')
            ->with('plot', $plot)
            ->with('wapi', $wapi);
    }

    public function new_plot_batch(Request $request) {


        return 'Processing the file...';
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

    private function addPlotToDb(Request $request, $path) {

        $certificate = new Certificate();
        $certificate->path = $path;
        $certificate->save();

        $plot = new Plot();
        $plot->owner_id = $request->owner;
        $plot->area = $request->area;
        $plot->status_id = $request->get('status');
        $plot->usage_id = $request->get('usage');
        $plot->block_id = random_int(1, 50);
        $plot->plot_number = $request->get('plot-number');
        $plot->latitude = $request->lat;
        $plot->longitude = $request->lng;
        $plot->boundaries = $request->get('boundaries', null);
        $plot->certificate_id = $certificate->id;
        $plot->save();

        return $plot;

    }

}
