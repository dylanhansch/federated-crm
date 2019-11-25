<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerritoriesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('territories', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('district_id');
			$table->string('name')->unique();
			$table->timestamps();

			$table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('territories');
	}
}
