<?php

use Illuminate\Database\Seeder;

class UserAlbumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $users = [
	        'Sean Beck' => ['Bringing It All Back Home','In My Own Time','Microcastle','Blood on the Tracks'],
	        'Testy Testerson' => ['Bringing It All Back Home'],
	        'Vinyl Guy' => ['Microcastle','Halcyon Digest']
	    ];

	   
	    foreach($users as $name => $albums) {
	     
	        $user = \App\User::where('name','like', $name)->first();
	       	
	        foreach($albums as $albumTitle) {
	            $album = \App\Album::where('title','LIKE',$albumTitle)->first();

	           
	            $user->albums()->save($album);
	        }
	    }
    }
}
