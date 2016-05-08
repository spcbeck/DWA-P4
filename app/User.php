<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Session;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function albums() {
        return $this->belongsToMany('\App\Album')->withTimestamps();
    }

    public function artists() {
      $artist_ids = \DB::table('album_user')->where('user_id', $this->id)->lists('album_id');
      return \App\Artist::whereIn('id', $artist_ids)->get();
    }
}
