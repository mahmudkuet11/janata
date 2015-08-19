<?php

class CustomerController extends BaseController{
	public function postAddNewCustomer(){
		$name 		= Input::get('name');
		$phone 		= Input::get('phone');
		$address 	= Input::get('address');
		$active 	= 1;

		try{
			DB::table('customers')->insert(array(
				'name'		=>	$name,
				'phone'		=>	$phone,
				'address'	=>	$address,
				'active'	=>	$active,
			));
			return 1;
		}catch(\Exception $e){
			return 0;
		}
	}
	public function getCustomer(){
		$customers = DB::select(DB::raw("SELECT * FROM `customers` WHERE active=1"));
		return json_encode($customers);
	}

	public function postEditCustomer(){
		$id 		= Input::get('id');
		$name 		= Input::get('name');
		$phone 		= Input::get('phone');
		$address 	= Input::get('address');

		return DB::table('customers')->where('id', $id)->update(array(
				'name'		=>	$name,
				'phone'		=>	$phone,
				'address'	=>	$address,
			));

	}

	public function postDeleteCustomer(){
		$id = Input::get('id');
		return DB::table('customers')->where('id',$id)->update(array('active'	=>	0));
	}
}