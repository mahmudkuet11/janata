<?php

class UserSeeder extends Seeder{
	public function run(){
		DB::table('users')->insert(array(
				'username'	=>	'admin',
				'password'	=>	'admin'
			));
	}
}