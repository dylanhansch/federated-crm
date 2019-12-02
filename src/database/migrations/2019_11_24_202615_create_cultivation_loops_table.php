<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCultivationLoopsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('cultivation_loops', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('cultivation_loop_phase_id');
			$table->unsignedBigInteger('customer_id');
			$table->date('due_date');
			$table->enum('status', ['COMPLETE', 'IN-PROGRESS', 'NOT-STARTED']);
			$table->text('notes')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('cultivation_loops');
	}
}
