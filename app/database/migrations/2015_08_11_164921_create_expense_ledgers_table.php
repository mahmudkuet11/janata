<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseLedgersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expense_ledgers', function($t){
			$t->bigIncrements('id');
			$t->date('date');
			$t->bigInteger('category');
			$t->string('description');
			$t->decimal('amount', 15, 2);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('expense_ledgers');
	}

}
