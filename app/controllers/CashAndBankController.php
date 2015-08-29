<?php

class CashAndBankController extends BaseController{
	public function postCashDeposit(){
		$date = Input::get('date');
		$narration = Input::get('narration');
		$amount = Input::get('amount');

		DB::beginTransaction();
		try{
			$row = DB::select(DB::raw("select balance from cash_ledgers order by id desc limit 1"));
			if($row){
				$balance = $row[0]->balance;
			}else{
				$balance = 0;
			}
			DB::table('cash_ledgers')->insert(array(
					'date'	=>	$date,
					'narration'	=>	$narration,
					'amount'	=>	$amount,
					'balance'	=>	$balance + $amount
				));
			DB::commit();
			return 1;
		}catch(\Exception $e){
			DB::rollback();
			return 0;
		}


	}

	public function postCashWithdraw(){
		$date = Input::get('date');
		$narration = Input::get('narration');
		$amount = Input::get('amount');

		DB::beginTransaction();
		try{
			$row = DB::select(DB::raw("select balance from cash_ledgers order by id desc limit 1"));
			if($row){
				$balance = $row[0]->balance;
			}else{
				$balance = 0;
			}
			DB::table('cash_ledgers')->insert(array(
					'date'	=>	$date,
					'narration'	=>	$narration,
					'amount'	=>	$amount * (-1),
					'balance'	=>	$balance - $amount
				));
			DB::commit();
			return 1;
		}catch(\Exception $e){
			DB::rollback();
			return 0;
		}
	}

	public function postBankDeposit(){
		$date = Input::get('date');
		$narration = Input::get('narration');
		$amount = Input::get('amount');

		DB::beginTransaction();
		try{
			$row = DB::select(DB::raw("select balance from bank_ledgers order by id desc limit 1"));
			if($row){
				$balance = $row[0]->balance;
			}else{
				$balance = 0;
			}
			DB::table('bank_ledgers')->insert(array(
					'date'	=>	$date,
					'narration'	=>	$narration,
					'amount'	=>	$amount,
					'balance'	=>	$balance + $amount
				));
			DB::commit();
			return 1;
		}catch(\Exception $e){
			DB::rollback();
			return 0;
		}


	}

	public function postBankWithdraw(){
		$date = Input::get('date');
		$narration = Input::get('narration');
		$amount = Input::get('amount');

		DB::beginTransaction();
		try{
			$row = DB::select(DB::raw("select balance from bank_ledgers order by id desc limit 1"));
			if($row){
				$balance = $row[0]->balance;
			}else{
				$balance = 0;
			}
			DB::table('bank_ledgers')->insert(array(
					'date'	=>	$date,
					'narration'	=>	$narration,
					'amount'	=>	$amount * (-1),
					'balance'	=>	$balance - $amount
				));
			DB::commit();
			return 1;
		}catch(\Exception $e){
			DB::rollback();
			return 0;
		}

	}

	public function getCashReport(){
		$start = Input::get('start_date');
		$end = Input::get('end_date');

		return DB::table('cash_ledgers')->whereBetween('date', array($start, $end))->get();
	}
	public function getBankReport(){
		$start = Input::get('start_date');
		$end = Input::get('end_date');

		return DB::table('bank_ledgers')->whereBetween('date', array($start, $end))->get();
	}
}