<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerContactsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('customer_contacts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('customer_id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('type');
			$table->date('birth_date')->nullable();
			$table->string('phone_number', 13)->nullable();
			$table->string('email')->nullable();
			$table->timestamps();

			$table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('customer_contacts');
	}
}
