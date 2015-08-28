<?php

class SellController extends BaseController{

	public function postAddSellVoucher(){
		DB::beginTransaction();
		try{

			$date = Input::get('date');
			$customer_id = Input::get('customer_id');
			$note = Input::get('note');
			$items_info = Input::get('items_info');

			DB::table('sell_vouchers')->insert(array(
					'date'	=>	$date,
					'customer_id'	=>	$customer_id,
					'note'	=>	$note,
					'items_info'	=>	$items_info
				));
			$items = json_decode($items_info);

			foreach ($items as $item) {
				$category_id = $item->category_id;
				$caret = $item->caret;
				$quantity = $item->quantity;
				$sell_rate = $item->sell_rate;
				$paid_amount = $item->paid_amount;
				$due = $item->due;
				$loss = $item->loss;
				DB::table('sell_ledgers')->insertGetId(array(
						'date'	=>	$date,
						'category_id'	=>	$category_id,
						'caret'	=>	$caret,
						'quantity'	=>	$quantity,
						'sell_rate'	=>	$sell_rate,
						'customer_id'	=>	$customer_id,
						'paid_amount'	=>	$paid_amount,
						'due'	=>	$due,
						'note'	=>	$note,
						'total_loss_weight'	=>	$loss
					));

				$current_quantity = DB::table('categories')->where('id', $category_id)->first()->current_quantity;
				$current_quantity = $current_quantity - $quantity;
				DB::table('categories')->where('id', $category_id)->update(array(
						'current_quantity'	=>	$current_quantity
					));

			}


			DB::commit();
			return 1;
		}catch(\Exception $e){
			DB::rollback();
			return $e->getMessage();
			return 0;
		}
	}

	public function getSellVoucher(){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');
		return json_encode(DB::table('sell_vouchers')->whereBetween('date', array($start_date, $end_date))->get());
	}

}