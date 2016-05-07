<?php

use Illuminate\Database\Seeder;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$artist_id = \App\Artist::where('name','=','Karen Dalton')->pluck('id')->first();
         DB::table('albums')->insert([
	        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
	        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
	        'title' => 'In My Own Time',
	        'type' => 'LP',
	        'format' => "vinyl",
	        'cover' => "https://upload.wikimedia.org/wikipedia/en/thumb/0/09/In_My_Own_Time.jpg/440px-In_My_Own_Time.jpg",
	        'published' => 1971,
	        'artist_id' => $artist_id,
        ]);

        $artist_id = \App\Artist::where('name','=','Deerhunter')->pluck('id')->first();
        DB::table('albums')->insert([
	        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
	        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
	        'title' => 'Microcastle',
	        'type' => 'LP',
	        'format' => "vinyl",
	        'cover' => "https://upload.wikimedia.org/wikipedia/en/thumb/9/92/Deerhunter-Microcastle.jpg/440px-Deerhunter-Microcastle.jpg",
	        'published' => 2008,
	        'artist_id' => $artist_id,
        ]);


        DB::table('albums')->insert([
	        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
	        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
	        'title' => 'Halcyon Digest',
	        'type' => 'LP',
	        'format' => "vinyl",
	        'cover' => "https://upload.wikimedia.org/wikipedia/en/8/89/Halcyon_Digest_-_%28Front_Cover%29.png",
	        'published' => 2010,
	        'artist_id' => $artist_id,
        ]);

        $artist_id = \App\Artist::where('name','=','Bob Dylan')->pluck('id')->first();
        DB::table('albums')->insert([
	        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
	        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
	        'title' => 'Blood on the Tracks',
	        'type' => 'LP',
	        'format' => "vinyl",
	        'cover' => "https://upload.wikimedia.org/wikipedia/en/f/fa/Bob_Dylan_-_Blood_on_the_Tracks.jpg",
	        'published' => 1975,
	        'artist_id' => $artist_id,
        ]);


        DB::table('albums')->insert([
	        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
	        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
	        'title' => 'Bringing It All Back Home',
	        'type' => 'LP',
	        'format' => "vinyl",
	        'cover' => "https://upload.wikimedia.org/wikipedia/en/b/b1/Bob_Dylan_-_Bringing_It_All_Back_Home.jpg",
	        'published' => 1965,
	        'artist_id' => $artist_id,
        ]);
    }
}
