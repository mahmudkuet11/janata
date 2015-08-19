<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellLedgersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sell_ledgers', function($t){
			$t->bigIncrements('id');
			$t->date('date');
			$t->bigInteger('category_id');
			$t->integer('caret');
			$t->BigInteger('quantity');
			$t->decimal('sell_rate', 15, 2);
			$t->bigInteger('customer_id');
			$t->decimal('paid_amount', 15, 2);
			$t->decimal('due', 15, 2);
			$t->string('note');
			$t->decimal('total_loss_weight');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('sell_ledgers');
	}

}
