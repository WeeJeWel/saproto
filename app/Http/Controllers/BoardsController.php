<?php

namespace Proto\Http\Controllers;

use Illuminate\Http\Request;

use Proto\Http\Requests;
use Proto\Http\Controllers\Controller;
use Proto\Models\Flickr;
use Proto\Models\PhotoLikes;
use Proto\Models\Board;
use Proto\Models\Committee;
use Auth;

use Proto\Models\FlickrAlbum;
use Redirect;

class BoardsController extends Controller {

    public function index() {

        return view('boards.list', ['data' => Board::orderby('id', 'des')->get()]);


    }

    public function show($id)
    {
        $board = Board::where('id', $id)->first();
        $committee = Committee::where('id',24)->first();
        $members = $committee->allmembers();
        $memberships = $members['editions'][$board->edition];
        return view('boards.show', ['data' => $board,'memberships'=> $memberships]);
    }



}