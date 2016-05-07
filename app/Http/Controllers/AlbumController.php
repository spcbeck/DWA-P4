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

        $artist_input = $request->artist;

        $artist = \App\Artist::where('name', "=", $artist_input)->first();

        if(empty($artist)){ 
            $new_artist = new \App\Artist();

            $new_artist->name = $artist_input;
            $new_artist->biography = "";
            $new_artist->picture = "";
            $new_artist->save();
        }

        $album = new \App\Album();
        $album->title = $request->title;
        $album->published = 0;
        $album->cover = "";
        $album->type = $request->type;
        $album->format = $request->format;

        if(empty($artist)){
            $album->artist_id = $new_artist->id;
        } else {
            $album->artist_id = $artist->id;
        }

        $album->save();

    	$tracks = [];
    	return view("layout.master")->nest('content', 'album.info', ['title' => $request->title, 'artist' => $request->artist, 'tracks' => $tracks]);
    }

    public function getAlbums() {
    	$albums = ["Lonesome Crowded West", "Paranoid Android", "Weezer"];
    	$title = "Albums";

    	return view("layout.master")->nest('content', 'layout.grid', ["albums" => $albums, "title" => $title, "ids" => $ids]);
    }
}
