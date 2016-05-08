<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::firstOrCreate(['email' => 'spcbeck@gmail.com']);
	    $user->name = 'Sean Beck';
	    $user->email = 'spcbeck@gmail.com';
	    $user->password = \Hash::make('Dogface1.');
	    $user->save();

	    $user = \App\User::firstOrCreate(['email' => 'idiot@test.com']);
	    $user->name = 'Testy Testerson';
	    $user->email = 'idiot@test.com';
	    $user->password = \Hash::make('blah');
	    $user->save();

	    $user = \App\User::firstOrCreate(['email' => 'test@test.com']);
	    $user->name = 'Vinyl Guy';
	    $user->email = 'test@test.com';
	    $user->password = \Hash::make('test');
	    $user->save();

    }
}
