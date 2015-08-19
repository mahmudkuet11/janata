<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellVouchersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sell_vouchers', function($t){
			$t->bigIncrements('id');
			$t->date('date');
			$t->bigInteger('customer_id');
			$t->string('note');
			$t->string('items_info');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('sell_vouchers');
	}

}
