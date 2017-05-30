<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Plot;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AppController extends Controller {

    public function loginApp(Request $request) {

        $username = $request->get('username');
        $password = $request->get('password');

        $user = User::where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            return response()->json([$user]);
        } else {
            return response()->json([]);
        }

    }

    public function f(Request $request) {
        return response()->json(User::all());
    }

    public function plots($id) {
        return view('android.my_plots')->with('plots', User::find($id)->plots);

    }

    public function applications($id) {
        return User::find($id)->applications;
    }

    public function plotsOnSale() {
        return Plot::where('status_id', 1)->get();
    }

    public function announcements() {
        return Announcement::limit(12)->select('id', 'title', 'created_at')->get();
    }



}
