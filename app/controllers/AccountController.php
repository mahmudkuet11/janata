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

	public function postChangePassword(){
		$old = Input::get('old_password');
		$new = Input::get('new_password');

		$old_pass = DB::table('users')->where('username', 'admin')->first()->password;
		if($old == $old_pass){
			return DB::table('users')->where('username', 'admin')->update(array('password'=>$new));
		}else{
			return 0;
		}
	}
}