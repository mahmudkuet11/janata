<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseLedgersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_ledgers', function($t){
			$t->bigIncrements('id');
			$t->date('date');
			$t->bigInteger('category_id');
			$t->integer('caret');
			$t->bigInteger('quantity');
			$t->decimal('purchase_rate', 15, 2);
			$t->bigInteger('supplier_id');
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
		Schema::dropIfExists('purchase_ledgers');
	}

}
