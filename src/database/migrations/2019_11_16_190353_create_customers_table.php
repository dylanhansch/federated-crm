<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('customers', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('territory_id');
			$table->string('first_name');
			$table->string('middle_name')->nullable();
			$table->string('last_name');
			$table->string('street_address_1');
			$table->string('street_address_2')->nullable();
			$table->string('city');
			$table->string('subdivision');
			$table->string('postal_code', 10);
			$table->string('country');
			$table->string('company_name')->nullable();
			$table->string('business_type')->nullable();
			$table->string('website')->nullable();
			$table->string('phone_number', 13);
			$table->string('email');
			$table->enum('status', ['CURRENT', 'PREVIOUS', 'PROSPECT']);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('customers');
	}
}
