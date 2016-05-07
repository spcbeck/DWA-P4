<?php

use Illuminate\Database\Seeder;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('artists')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'name' => 'Bob Dylan',
        'biography' => 'https://en.wikipedia.org/wiki/Bob_Dylan',
        'picture' => "https://upload.wikimedia.org/wikipedia/commons/thumb/0/02/Bob_Dylan_-_Azkena_Rock_Festival_2010_2.jpg/440px-Bob_Dylan_-_Azkena_Rock_Festival_2010_2.jpg",
        ]);

        DB::table('artists')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'name' => 'Deerhunter',
        'biography' => 'https://en.wikipedia.org/wiki/Deerhunter',
        'picture' => "https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Deerhunter_at_Coachella.jpg/533px-Deerhunter_at_Coachella.jpg",
        ]);

        DB::table('artists')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'name' => 'Karen Dalton',
        'biography' => 'https://en.wikipedia.org/wiki/Karen_Dalton_(singer)',
        'picture' => "https://upload.wikimedia.org/wikipedia/en/7/7c/KarenDalton.jpg",
        ]);
    }
}
