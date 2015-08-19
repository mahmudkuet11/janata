<?php

class AccountController extends BaseController{
	public function getLogin(){
		$username = Input::get('username');
		$password = Input::get('password');

		$user = DB::table('users')->where('username', $username)->first();
		if($user){
			if($user->password == $password){
				return 'ok';
			}else{
				return 'password_error';
			}
		}else{
			return 'username_error';
		}

	}
}