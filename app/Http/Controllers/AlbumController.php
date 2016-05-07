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
    	$title = $request->input("title");
    	$artist = $request->input("artist");

        $data = $request->only('title','author_id','published','cover','purchase_link');
    	$tracks = [];
    	return view("layout.master")->nest('content', 'album.info', ['title' => $title, 'artist' => $artist, 'tracks' => $tracks]);
    }

    public function getAlbums() {
    	$albums = ["Lonesome Crowded West", "Paranoid Android", "Weezer"];
    	$title = "Albums";

    	return view("layout.master")->nest('content', 'layout.grid', ["albums" => $albums, "title" => $title, "ids" => $ids]);
    }
}
