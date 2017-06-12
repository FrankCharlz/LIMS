<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function manage(Request $request) {
        if ((int)Auth::user()->role_id !== 2) return 'You re not an admin!';

        $type = $request->get('t', 'all');

        if ($type === 'managers') {
            $users = User::where('role_id', 1)->where('voided', 0)->get();
        } else if ($type === 'admins') {
            $users = User::where('role_id', 2)->where('voided', 0)->get();
        } else if ($type === 'users') {
            $users = User::where('role_id', 0)->where('voided', 0)->get();
        } else if ($type === 'deactivated') {
            $users = User::where('voided', 1)->get();
        } else {
            $users = User::where('voided', 0)->get();
        }

        return view('users')->with('users', $users);
    }

    public function voidily($uid) {
        //todo: url attack
        $user = User::find($uid);

        if ((int)$user->voided === 0) $user->voided = 1;
        else $user->voided = 0;

        $user->save();
    }
}
