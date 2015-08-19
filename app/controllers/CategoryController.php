<?php

class CategoryController extends BaseController{
	public function postAddCategory(){
		$name 				= Input::get('name');
		$purchase_price 	= Input::get('purchase_price');
		$sell_price 		= Input::get('sell_price');
		$warning_quantity 	= Input::get('warning_quantity');
		$current_quantity 	= 0;
		$active 			= 1;

		try{
			DB::table('categories')->insertGetId(array(
				'name'				=>	$name,
				'purchase_price'	=>	$purchase_price,
				'sell_price'		=>	$sell_price,
				'warning_quantity'	=>	$warning_quantity,
				'current_quantity'	=>	$current_quantity,
				'active'			=>	$active
			));
			return 1;
		}catch(\Exception $e){
			return 0;
		}

	}

	public function getAllCategories(){
		return json_encode(DB::table('categories')->where('active', 1)->get());
	}
	public function postEditCategory(){
		$id 				= Input::get('id');
		$name 				= Input::get('name');
		$purchase_price 	= Input::get('purchase_price');
		$sell_price 		= Input::get('sell_price');
		$warning_quantity	= Input::get('warning_quantity');

		return DB::table('categories')->where('id', $id)->update(array(
				'name'				=>	$name,
				'purchase_price'	=>	$purchase_price,
				'sell_price'		=>	$sell_price,
				'warning_quantity'	=>	$warning_quantity
			));

	}

	public function postDeleteCategory(){
		$id = Input::get('id');

		return DB::table('categories')->where('id', $id)->update(array(
				'active'	=>	0
			));
	}
}