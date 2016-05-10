<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SpotifyWebAPI\SpotifyWebAPI;

use App\Http\Requests;

class AlbumController extends Controller
{
     /**
     * Responds to requests to POST /album/add
     */
    public function postAddAlbum(Request $request) {
        $title_input = $request->title;
        $artist_input = $request->artist;
        $cover_url = "";

        $album = \App\Album::where("title", "like", $title_input)->first();
        $artist = \App\Artist::where('name', "=", $artist_input)->first();

        //If the artist typed in doesn't match any current Artists, get the cover and add the new artist to the artist database.
        if(empty($artist)){ 
            $new_artist = new \App\Artist();

            $api = new SpotifyWebAPI();
            $results_raw = $api->search($artist_input, 'artist');
            $results = json_decode(json_encode($results_raw), true);
            $picture = $results["artists"]["items"][0]["images"][0]["url"];

            $new_artist->name = $artist_input;
            $new_artist->biography = "";
            $new_artist->picture = $picture;
            $new_artist->save();
        }

        // if this is a new album, let's get some important information from spotify
        if(empty($album)) {
            $api = new SpotifyWebAPI();
            $results = $api->search($title_input, 'album');
            $results = json_decode(json_encode($results), true);
            $cover_url = $results["albums"]["items"][0]["images"][1]["url"];
            $spotify_id = $results["albums"]["items"][0]["id"];

            $spotify_album = $api->getAlbum($spotify_id);

            //create track list from spotify
            foreach( $spotify_album->tracks->items as $item) {
                $tracks[] = $item;
            }

            $album = new \App\Album();
            $album->title = $request->title;
            $album->published = 0;
            $album->cover = $cover_url;
            $album->type = $request->type;
            $album->format = $request->format;

            if(empty($artist)){
                $album->artist_id = $new_artist->id;
            } else {
                $album->artist_id = $artist->id;
            }

            //get the current user and save the album to the current user's album list
            $id = \Auth::user()->id;
            $currentuser = \App\User::find($id);

            $currentuser->albums()->save($album);
        }

        return redirect("/albums/$album->id");
    }

    public function getAlbum($id = null) {
        $album = \App\Album::with("artist")->find($id);
        if(is_null($album)) {
            \Session::flash('message','Album not found');
            return redirect('/albums');
        }


        $api = new SpotifyWebAPI();
        $results = $api->search($album->title, 'album');
        $results = json_decode(json_encode($results), true);
        $spotify_id = $results["albums"]["items"][0]["id"];
        $spotify_album = $api->getAlbum($spotify_id);

        //create track list from spotify
        foreach( $spotify_album->tracks->items as $item) {
            $tracks[] = $item;
        }


        return view("layout.master", ["type" => "album"])->nest("content", 'album.info', ['artist' => $album->artist->name, 'tracks' => $tracks, 'cover_url' => $album->cover, "data" => $album, "type" => "album", "tracks" => $tracks]);
    }


    public function getAlbums() {
        $id = \Auth::user()->id;
        $currentuser = \App\User::find($id);
    	$user = \App\User::where("id","=", $currentuser->id)->with("albums")->first();
    	$title = "Albums";

        $albums = $user->albums->sortBy('title');

    	return view("layout.master", ["type" => "album"])->nest('content', 'layout.grid', ["data" => $albums, "title" => $title, "type" => "album"]);
    }

    public function deleteAlbum() {
        $id = \Auth::user()->id;
        $currentuser = \App\User::find($id);
        //$
    }
}
