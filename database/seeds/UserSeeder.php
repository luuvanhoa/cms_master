<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
    	DB::table('users')->delete();
        DB::table('users')->insert([
        	'id'=> 1,
			'name' => 'admin',
			'username' => 'admin',
            'fullname' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'group_id' => 1,
            'address' => '',
            'phone' => '',
            'birthday' => Carbon::now(),
            'token_login' => ''
		]);
    }
}