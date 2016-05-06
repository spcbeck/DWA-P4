<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AlbumController extends Controller
{
     /**
     * Responds to requests to POST /album/add
     */
    public function postAddAlbum(Request $request) {
    	//$request->input("name");
    	//$request->input("artist");
    	$name = $request->input("name");
    	return view("layout.master")->nest('content', 'album.info', ['name' => $name]);
    }
}
