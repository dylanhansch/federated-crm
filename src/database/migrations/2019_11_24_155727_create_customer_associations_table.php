<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAssociationsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('customer_associations', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('association_id');
			$table->unsignedBigInteger('customer_id');
			$table->timestamps();

			$table->unique(['association_id', 'customer_id']);

			$table->foreign('association_id')->references('id')->on('associations')->onDelete('cascade');
			$table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('customer_associations');
	}
}
