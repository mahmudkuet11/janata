<?php

class SupplierController extends BaseController{

	public function postAddSupplier(){
		$name 		= Input::get('name');
		$phone 		= Input::get('phone');
		$address 	= Input::get('address');
		$active 	= 1;

		try{
			DB::table('suppliers')->insert(array(
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
	public function getSupplier(){
		$suppliers = DB::select(DB::raw("SELECT * FROM `suppliers` WHERE active=1"));
		return json_encode($suppliers);
	}

	public function postEditSupplier(){
		$id 		= Input::get('id');
		$name 		= Input::get('name');
		$phone 		= Input::get('phone');
		$address 	= Input::get('address');

		return DB::table('suppliers')->where('id', $id)->update(array(
				'name'		=>	$name,
				'phone'		=>	$phone,
				'address'	=>	$address,
			));

	}

	public function postDeleteSupplier(){
		$id = Input::get('id');
		return DB::table('suppliers')->where('id',$id)->update(array('active'	=>	0));
	}

}