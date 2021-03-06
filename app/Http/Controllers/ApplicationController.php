<?php

namespace App\Http\Controllers;

use App\Application;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

    }


    public function create_view() {
        return view('app-add');
    }

    public function create($pid) {
        $application = new Application();
        $application->plot_id = $pid;
        $application->user_id = Auth::id();
        $application->save();
    }

    public function cancel($id) {
        $application = Application::find($id);
        $application->status = 1; //status cancelled
        $application->save();
    }

    public function delete($id) {
        $application = Application::find($id);
        $application->status = 2; //deleted by admin
        $application->save();
    }

    public function listForUser() {
        //dd(Auth::id());
        $applications = User::find(Auth::id())->applications;
        return view('applications')->with('applications', $applications);
    }

    public function listAll() {
        $applications = Application::where('status', '<', 2)->orderBy('plot_id', 'asc')->get(); //exclude completeed and deleted
        return view('applications-manage')->with('applications', $applications);
    }


    public function destroy($id) {

    }
}
