<?php

class PurchaseController extends BaseController{
	public function postAddPurchaseVoucher(){
		DB::beginTransaction();
		try{
			// insert into purchase voucher table
			$date 			= Input::get('date');
			$supplier_id 	= Input::get('supplier_id');
			$note 			= Input::get('note');
			$items_info 	= Input::get('items_info');

			DB::table('purchase_vouchers')->insert(array(
					'date'			=>	$date,
					'supplier_id'	=>	$supplier_id,
					'note'			=>	$note,
					'items_info'	=>	$items_info
				));

			// insert items info in purchase ledgers
			$items = json_decode($items_info);
			foreach ($items as $item) {
				$category_id 	= $item->category_id;
				$caret 			= $item->caret;
				$quantity 		= $item->quantity;
				$purchase_rate 	= $item->purchase_rate;

				DB::table('purchase_ledgers')->insert(array(
						'date'			=>	$date,
						'category_id'	=>	$category_id,
						'caret'			=>	$caret,
						'quantity'		=>	$quantity,
						'purchase_rate'	=>	$purchase_rate,
						'supplier_id'	=>	$supplier_id,
						'note'			=>	$note
					));
				//increse current quantity in category table
				$qty = DB::table('categories')->where('id', $category_id)->first()->current_quantity;
				$qty = $qty + $quantity;
				DB::table('categories')->where('id', $category_id)->update(array(
						'current_quantity'	=>	$qty
					));
			}
			DB::commit();
			return 1;
		}catch(\Exception $e){
			DB::rollback();
			return 0;
		}

	}

	public function getPurchaseVoucher(){
		$start_date = Input::get('start_date');
		$end_date 	= Input::get('end_date');

		return json_encode(DB::table('purchase_vouchers')->whereBetween('date', array($start_date,$end_date))->get());
	}
}