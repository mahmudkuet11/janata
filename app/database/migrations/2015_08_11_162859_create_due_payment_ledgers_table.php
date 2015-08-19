<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDuePaymentLedgersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('due_payment_ledgers', function($t){
			$t->bigIncrements('id');
			$t->bigInteger('sell_id');
			$t->date('date');
			$t->decimal('amount', 15, 2);
			$t->string('note');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('due_payment_ledgers');
	}

}
