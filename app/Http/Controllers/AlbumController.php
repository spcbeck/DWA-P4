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

        $artist_input = $request->artist;

        $artist = \App\Artist::where('name', "=", $artist_input)->first();

        //If the artist typed in doesn't match any current Artists, add the new artist to the artist database.
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

        //get the current user and save the album to the current user's album list
        $id = \Auth::user()->id;
        $currentuser = \App\User::find($id);

        $currentuser->albums()->save($album);

        //TODO: pull in tracks from spotify
    	$tracks = [];
    	return view("layout.master")->nest('content', 'album.info', ['title' => $request->title, 'artist' => $request->artist, 'tracks' => $tracks]);
    }

    public function getAlbum($id = null) {
        $album = \App\Album::with("artist")->find($id);
        $api = new SpotifyWebAPI();


        $results = $api->search($album->title, 'album');


        $results = json_decode(json_encode($results), true);

        $spotify_id = $results["albums"]["items"][0]["id"];

        $spotify_album = $api->getAlbum($spotify_id);

        //create track list from spotify
        foreach( $spotify_album->tracks->items as $item) {
            $tracks[] = $item;
        }

        //get album cover from spotify
        $cover_url = $spotify_album->images[1]->url;

        if(is_null($album)) {
            \Session::flash('message','Book not found');
            return redirect('/albums');
        }
        return view("layout.master")->nest("content", 'album.info', ['artist' => $album->artist->name, 'tracks' => $tracks, 'cover_url' => $cover_url, "album" => $spotify_album]);
    }


    public function getAlbums() {
        $id = \Auth::user()->id;
        $currentuser = \App\User::find($id);
    	$user = \App\User::where("id","=", $currentuser->id)->with("albums")->first();
    	$title = "Albums";


    	return view("layout.master")->nest('content', 'layout.grid', ["data" => $user->albums, "title" => $title, "type" => "album"]);
    }
}
