<?php

class ReportController extends BaseController{
	public function getPurchaseReport(){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$rows = DB::table('purchase_ledgers')->whereBetween('date', array($start_date,$end_date))->get();
		$report = array();
		$sl = 1;
		foreach ($rows as $row) {
			$entry_id = $row->id;
			$date = $row->date;
			$category = $row->category_id;
			$caret = $row->caret;
			$supplier = $row->supplier_id;
			$quantity = $row->quantity;
			$purchase_rate = $row->purchase_rate;
			$total_amount = $quantity * $purchase_rate;
			$note = $row->note;

			$category_name = DB::table('categories')->where('id', $category)->first()->name;
			$supplier_name = DB::table('suppliers')->where('id', $supplier)->first()->name;

			array_push($report, array(
					'sl'	=>	$sl,
					'entry_id'	=>	$entry_id,
					'date'	=>	$date,
					'category'	=>	$category_name,
					'caret'	=>	$caret,
					'supplier'	=>	$supplier_name,
					'quantity'	=>	$quantity,
					'purchase_rate'	=>	$purchase_rate,
					'total_amount'	=>	$total_amount,
					'note'	=>	$note
				));
			$sl++;
		}

		return json_encode($report);
	}

	public function getPurchaseReportBySupplier($supplier_id){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$rows = DB::table('purchase_ledgers')->where('supplier_id', $supplier_id)->whereBetween('date', array($start_date,$end_date))->get();
		$report = array();
		$sl = 1;
		foreach ($rows as $row) {
			$entry_id = $row->id;
			$date = $row->date;
			$category = $row->category_id;
			$caret = $row->caret;
			$quantity = $row->quantity;
			$purchase_rate = $row->purchase_rate;
			$total_amount = $quantity * $purchase_rate;
			$note = $row->note;

			$category_name = DB::table('categories')->where('id', $category)->first()->name;

			array_push($report, array(
					'sl'	=>	$sl,
					'entry_id'	=>	$entry_id,
					'date'	=>	$date,
					'category'	=>	$category_name,
					'caret'	=>	$caret,
					'quantity'	=>	$quantity,
					'purchase_rate'	=>	$purchase_rate,
					'total_amount'	=>	$total_amount,
					'note'	=>	$note
				));
			$sl++;
		}

		return json_encode($report);
	}

	public function getSellReport(){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$rows = DB::table('sell_ledgers')->whereBetween('date', array($start_date, $end_date))->get();
		$report = array();
		$sl = 1;
		foreach ($rows as $row) {
			$entry_id = $row->id;
			$date = $row->date;
			$category = $row->category_id;
			$caret = $row->caret;
			$customer = $row->customer_id;
			$quantity = $row->quantity;
			$sales_rate = $row->sell_rate;
			$total_amount = $sales_rate * $quantity;
			$paid = $row->paid_amount;
			$due = $row->due;
			$loss = $row->total_loss_weight;
			$note = $row->note;

			$category_name = DB::table('categories')->where('id', $category)->first()->name;
			$customer_name = DB::table('customers')->where('id', $customer)->first()->name;
			array_push($report, array(
					'sl'	=>	$sl,
					'entry_id'	=>	$entry_id,
					'date'	=>	$date,
					'category'	=>	$category_name,
					'caret'	=>	$caret,
					'customer'	=>	$customer_name,
					'quantity'	=>	$quantity,
					'sales_rate'	=>	$sales_rate,
					'total_amount'	=>	$total_amount,
					'paid'	=>	$paid,
					'due'	=>	$due,
					'loss'	=>	$loss,
					'note'	=>	$note
				));
			$sl++;
		}
		return json_encode($report);
	}

	public function getSellReportByCustomer($customer_id){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$rows = DB::table('sell_ledgers')->where('customer_id', $customer_id)->whereBetween('date', array($start_date, $end_date))->get();
		$report = array();
		$sl = 1;
		foreach ($rows as $row) {
			$entry_id = $row->id;
			$date = $row->date;
			$category = $row->category_id;
			$caret = $row->caret;
			$quantity = $row->quantity;
			$sales_rate = $row->sell_rate;
			$total_amount = $sales_rate * $quantity;
			$paid = $row->paid_amount;
			$due = $row->due;
			$loss = $row->total_loss_weight;
			$note = $row->note;

			$category_name = DB::table('categories')->where('id', $category)->first()->name;
			array_push($report, array(
					'sl'	=>	$sl,
					'entry_id'	=>	$entry_id,
					'date'	=>	$date,
					'category'	=>	$category_name,
					'caret'	=>	$caret,
					'quantity'	=>	$quantity,
					'sales_rate'	=>	$sales_rate,
					'total_amount'	=>	$total_amount,
					'paid'	=>	$paid,
					'due'	=>	$due,
					'loss'	=>	$loss,
					'note'	=>	$note
				));
			$sl++;
		}
		return json_encode($report);
	}

	public function getProfitLossReport(){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$total_sell = DB::select(DB::raw("select sum(sell_rate*quantity) as total_sell,sum(paid_amount) as paid,sum(due) as due from sell_ledgers where date between '". $start_date ."' and '". $end_date ."'"));

		$total_purchase = DB::select(DB::raw("select sum(quantity*purchase_rate) as total_purchase from purchase_ledgers where date between '". $start_date ."' and '". $end_date ."'"));

		$total_expense = DB::select(DB::raw("select sum(amount) as total_expense from expense_ledgers where date between '". $start_date ."' and '". $end_date ."'"));

		return json_encode(array(
				'total_sell'	=>	$total_sell[0]->total_sell,
				'total_paid'	=>	$total_sell[0]->paid,
				'total_due'		=>	$total_sell[0]->due,
				'total_purchase'	=>	$total_purchase[0]->total_purchase,
				'total_expense'	=>	$total_expense[0]->total_expense
			));
	}

	public function getWeightLossReport(){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$rows = DB::table('sell_ledgers')->whereBetween('date', array($start_date, $end_date))->get();
		$sl = 0;
		$report = array();
		foreach ($rows as $row) {
			$date = $row->date;
			$category = $row->category_id;
			$caret = $row->caret;
			$loss = $row->total_loss_weight;
			$sl++;

			$category_name = DB::table('categories')->where('id', $category)->first()->name;

			array_push($report, array(
					'sl'	=>	$sl,
					'date'	=>	$date,
					'category'	=>	$category_name,
					'caret'	=>	$caret,
					'loss'	=>	$loss
				));
		}
		return json_encode($report);
	}

	public function getExpenseReport(){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$rows = DB::table('expense_ledgers')->whereBetween('date', array($start_date, $end_date))->get();
		$sl = 0;
		$report = array();
		foreach ($rows as $row) {
			$entry_id = $row->id;
			$date = $row->date;
			$category = $row->category;
			$desc = $row->description;
			$amount = $row->amount;
			$sl++;

			$category_name = DB::table('expense_categories')->where('id', $category)->first()->name;
			array_push($report, array(
					'sl'	=>	$sl,
					'entry_id'	=>	$entry_id,
					'date'	=>	$date,
					'category'	=>	$category_name,
					'description'	=>	$desc,
					'amount'	=>	$amount
				));
		}

		return json_encode($report);
	}

	public function getDueReport(){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$rows = DB::table('sell_ledgers')->whereBetween('date', array($start_date, $end_date))->get();
		$sl = 0;
		$report = array();
		foreach ($rows as $row) {
			$entry_id = $row->id;
			$date = $row->date;
			$customer_name = DB::table('customers')->where('id', $row->customer_id)->first()->name;
			$phone = DB::table('customers')->where('id', $row->customer_id)->first()->phone;
			$address = DB::table('customers')->where('id', $row->customer_id)->first()->address;
			$category = DB::table('categories')->where('id', $row->category_id)->first()->name;
			$caret = $row->caret;
			$quantity = $row->quantity;
			$paid = $row->paid_amount;
			$due = $row->due;
			$loss = $row->total_loss_weight;
			$note = $row->note;
			$sl++;

			array_push($report, array(
					'sl'	=>	$sl,
					'entry_id'	=>	$entry_id,
					'date'	=>	$date,
					'customer_name'	=>	$customer_name,
					'phone'	=>	$phone,
					'address'	=>	$address,
					'category'	=>	$category,
					'caret'	=>	$caret,
					'quantity'	=>	$quantity,
					'paid'	=>	$paid,
					'due'	=>	$due,
					'loss'	=>	$loss,
					'note'	=>	$note,
				));
		}

		return json_encode($report);
	}

	public function getStockReport(){
		$categories = DB::table('categories')->where('active',1)->get();
		$report = array();
		$sl = 1;
		foreach ($categories as $cat) {
			$p18 = DB::table('purchase_ledgers')->where('category_id', $cat->id)->where('caret',18)->sum('quantity');
			$p21 = DB::table('purchase_ledgers')->where('category_id', $cat->id)->where('caret',21)->sum('quantity');
			$p22 = DB::table('purchase_ledgers')->where('category_id', $cat->id)->where('caret',22)->sum('quantity');

			$s18 = DB::table('sell_ledgers')->where('category_id', $cat->id)->where('caret',18)->sum('quantity');
			$s21 = DB::table('sell_ledgers')->where('category_id', $cat->id)->where('caret',21)->sum('quantity');
			$s22 = DB::table('sell_ledgers')->where('category_id', $cat->id)->where('caret',22)->sum('quantity');

			$stock18 = $p18 - $s18;
			$stock21 = $p21 - $s21;
			$stock22 = $p22 - $s22;
			array_push($report, array(
					'sl'	=>	$sl,
					'category'	=>	$cat->name,
					'caret18'	=>	$stock18,
					'caret21'	=>	$stock21,
					'caret22'	=>	$stock22,
					'total'		=>	$stock18 + $stock21 + $stock22
				));
			$sl++;
		}
		return json_encode($report);
	}

	public function getLowStockReport(){
		$categories = DB::table('categories')->where('active',1)->get();
		$report = array();
		$sl = 1;
		foreach ($categories as $cat) {
			if($cat->current_quantity <= $cat->warning_quantity){
				array_push($report, array(
						'sl'	=>	$sl,
						'name'	=>	$cat->name,
						'warning_quantity'	=>	$cat->warning_quantity,
						'current_quantity'	=>	$cat->current_quantity
					));
				$sl++;
			}
			
		}
		return json_encode($report);
	}
}