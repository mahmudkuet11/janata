<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashLedgersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cash_ledgers', function($t){
			$t->bigIncrements('id');
			$t->date('date');
			$t->string('narration');
			$t->decimal('amount', 15, 2);
			$t->decimal('balance', 15, 2);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('cash_ledgers');
	}

}
