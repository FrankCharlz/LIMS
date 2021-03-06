<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AnnouncementController extends Controller {

    public function index() {
        $announcements = Announcement::orderBy('id', 'DESC')->paginate(5);
        return view('announcements')->with('announcements', $announcements);
    }

    public function create() {
        return view('announcement-add');
    }

    public function createPost(Request $request) {

        $ann = new Announcement();
        $ann->creator_id = Auth::user()->id;
        $ann->title = $request->get('heading');
        $ann->content = $request->get('editor1');
        $ann->save();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id) {
        return view('announcements-show')->with('announcement', Announcement::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
