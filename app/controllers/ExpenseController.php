<?php
class ExpenseController extends BaseController{
	public function postAddExpenseCategory(){
		$name 	= Input::get('name');
		$active = 1;

		try{
			DB::table('expense_categories')->insert(array(
					'name'		=>	$name,
					'active'	=>	$active
				));
			return 1;
		}catch(\Exception $e){
			return 0;
		}

	}

	public function getAllExpenseCategories(){
		return json_encode(DB::table('expense_categories')->where('active', 1)->get());
	}

	public function postEditExpenseCategory(){
		$name 	= Input::get('name');
		$id 	= Input::get('id');

		return DB::table('expense_categories')->where('id', $id)->update(array(
				'name'	=>	$name
			));

	}

	public function postDeleteExpenseCategory(){
		$id = Input::get('id');

		return DB::table('expense_categories')->where('id', $id)->update(array(
				'active'	=>	0
			));
	}

	public function postAddExpenseVoucher(){
		$date = Input::get('date');
		$category = Input::get('category');
		$description = Input::get('description');
		$amount = Input::get('amount');

		DB::beginTransaction();
		try{
			DB::table('expense_ledgers')->insert(array(
					'date'	=>	$date,
					'category'	=>	$category,
					'description'	=>	$description,
					'amount'	=>	$amount
				));
			DB::commit();
			return 1;
		}catch(\Exception $e){
			DB::rollback();
			return 0;
		}

	}

	public function getAllExpenseVoucher(){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		return json_encode(DB::table('expense_ledgers')->whereBetween('date', array($start_date, $end_date))->get());
	}
}