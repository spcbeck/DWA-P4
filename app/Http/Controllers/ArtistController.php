<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Discogs\ClientFactory;
use SpotifyWebAPI\SpotifyWebAPI;

use App\Http\Requests;


class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = \Auth::user()->id;
        $currentuser = \App\User::find($id);
        $user = \App\User::where("id","=", $currentuser->id)->with("albums", 'albums.artist')->first();
        $title = "Artists";

        $artists = $user->albums;

        return $user->artists();



        return view("layout.master", ["type" => "artist"])->nest('content', 'layout.grid', ["data" => $artists, "title" => $title, "type" => "artist"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artist = \App\Artist::get()->find($id);

        $api = new SpotifyWebAPI();
        $results = $api->search($artist->name, 'artist');
        $results = json_decode(json_encode($results), true);

        $spotify_id = $results["artists"]["items"][0]["id"];

        $albums_container = $api->getArtistAlbums($spotify_id);
        $related_artists = $api->getArtistRelatedArtists($spotify_id);


        //create track list from spotify
        foreach( $albums_container->items as $item) {
            $albums[] = $item->name;
        }

        return view("layout.master", ["type" => "album"])->nest("content", 'album.info', ['data' => $artist, 'tracks' => $albums, 'cover_url' => $artist->picture, "type" => "artist", "related_artists" => $related_artists->artists]);
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
