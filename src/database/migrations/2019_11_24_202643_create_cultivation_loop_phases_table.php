<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCultivationLoopPhasesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('cultivation_loop_phases', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name')->unique();
		});

		DB::table('cultivation_loop_phases')
			->insert([
				'name' => 'Risk Control Review'
			]);

		DB::table('cultivation_loop_phases')
			->insert([
				'name' => 'Financial Protection Review'
			]);

		DB::table('cultivation_loop_phases')
			->insert([
				'name' => 'Annual Client Review'
			]);

		DB::table('cultivation_loop_phases')
			->insert([
				'name' => 'Client Continuation Plan'
			]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('cultivation_loop_phases');
	}
}
