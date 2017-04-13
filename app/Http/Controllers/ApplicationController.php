<?php

namespace App\Http\Controllers;

use App\Application;
use App\User;
use Illuminate\Http\Request;

class ApplicationController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

    }


    public function create_view() {
        return view('app-add');
    }

    public function create() {

    }

    public function store(Request $request) {
        //
    }


    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {

    }

    public function listForUser($id) {
        $applications = User::find($id)->applications;
        return view('applications')->with('applications', $applications);
    }

    public function listAll() {
        $applications = Application::all();
        return view('applications')->with('applications', $applications);
    }


    public function destroy($id) {

    }
}
