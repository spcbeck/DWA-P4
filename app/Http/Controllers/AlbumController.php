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
        $this->validate($request,[
            'title' => 'required|min:3',
            'artist' => 'required|min:4',
        ]);
        
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

            $time_in_ms = $item->duration_ms;

            $uSec = $time_in_ms % 1000;
            $time_in_ms = floor($time_in_ms / 1000);

            $seconds = $time_in_ms % 60;
            $time_in_ms = floor($time_in_ms / 60);

            $minutes = $time_in_ms % 60;
            $time_in_ms = floor($time_in_ms / 60); 

            $item->duration_ms = $minutes.":".$seconds;
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

    public function deleteAlbum($id = null) {
        $id = \Auth::user()->id;
        $currentuser = \App\User::find($id);
        $albums = \DB::table("user_album")->where("user_id", "=", $currentuser)->get();

        return $albums;
    }

    public function getEditAlbum($id = null) {
        $album = \App\Album::with("artist")->find($id);
        if(is_null($album)) {
            \Session::flash('message','Album not found');
            return redirect('/albums');
        }

        return view("layout.master", ["type" => "album"])->nest("content", 'album.edit', ["type" => "album", "album" => $album]);
    }

    public function postEditAlbum(Request $request) {

        $this->validate($request,[
            'title' => 'required|min:3',
            'artist' => 'required|min:4',
        ]);

        $album = \App\Album::find($request->id);
        $album->title = $request->title;
        $album->artist->name = $request->artist;
        $album->type = $request->type;
        $album->format = $request->format;

        $album->save();

        \Session::flash('message','Your changes were saved.');
        return redirect('/albums/'.$request->id);
    }

    public function getConfirmDelete($id) {
        $album = \App\Album::find($id);

        return view('album.delete', ["type" => $album])->with('album', $album);
    }

    public function getDoDelete($id) {
        $user_id = \Auth::user()->id;
        $currentuser = \App\User::find($user_id);

        $album = \DB::table("albums")->find($id);

        if(is_null($album)) {
            \Session::flash('message','Album not found.');
            return redirect('\albums');
        }

        return  \DB::table("album_user")->where("user_id", "=", $user_id)->where("album_id", "=", $id)->get();


        \DB::table("album_user")->where("user_id", "=", $user_id)->where("album_id", "=", $id)->delete();

        # Done
        \Session::flash('message', $album->title.' was removed from your collection.');
        return redirect('/albums');
    }
}
