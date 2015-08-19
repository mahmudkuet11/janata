<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function($t){
			$t->bigIncrements('id');
			$t->string('name');
			$t->decimal('purchase_price', 15,2);
			$t->decimal('sell_price',15,2);
			$t->bigInteger('warning_quantity');
			$t->bigInteger('current_quantity');
			$t->integer('active');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('categories');
	}

}
