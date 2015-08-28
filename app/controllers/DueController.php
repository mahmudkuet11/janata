<?php

class DueController extends BaseController{
	public function postAddDueVoucher(){
		$sell_id = Input::get('sell_id');
		$date = Input::get('date');
		$amount = Input::get('amount');
		$note = Input::get('note');

		DB::beginTransaction();
		try{
			DB::table('due_payment_ledgers')->insert(array(
					'sell_id'	=>	$sell_id,
					'date'	=>	$date,
					'amount'	=>	$amount,
					'note'	=>	$note
				));
			$due = DB::table('sell_ledgers')->where('id', $sell_id)->first()->due;
			$due = $due - $amount;
			DB::table('sell_ledgers')->where('id', $sell_id)->update(array(
					'due'	=>	$due
				));

			$paid = DB::table('sell_ledgers')->where('id', $sell_id)->first()->paid_amount;
			DB::table('sell_ledgers')->where('id', $sell_id)->update(array(
					'paid_amount'	=>	$paid + $amount
				));
			DB::commit();
			return 1;
		}catch(\Exception $e){
			DB::rollback();
			return 0;
		}

	}

	public function getAllDueVouchers(){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');
		return json_encode(DB::table('due_payment_ledgers')->whereBetween('date', array($start_date, $end_date))->get());
	}

	public function getAllDueVouchersByCustomer($id){
		$res = DB::table('sell_ledgers')->where('customer_id', $id)->get();
		$result = array();
		foreach ($res as $r) {
			$cat = DB::table('categories')->where('id', $r->category_id)->first()->name;
			array_push($result, array(
					'id'	=>	$r->id,
					'date'	=>	$r->date,
					'category'	=>	$cat,
					'caret'	=>	$r->caret,
					'quantity'	=>	$r->quantity,
					'rate'	=>	$r->sell_rate,
					'paid'	=>	$r->paid_amount,
					'due'	=>	$r->due,
					'note'	=>	$r->note,
					'loss'	=>	$r->total_loss_weight,
				));
		}
		return json_encode($result);
	}
}