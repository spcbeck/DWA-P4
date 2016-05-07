<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['title','artist_id','published','cover','type','format'];

    public function artist() {
        return $this->belongsTo('\App\Artist');
    }

    public static function getAllAlbumsWithArtists() {
        return \App\Album::with('artist')->orderBy('id','desc')->get();
    }
}
