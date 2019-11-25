<?php

namespace Seeds\Demo;

use App\Territory;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$territory = Territory::first();

		factory('App\Customer', 5)->create(['territory_id' => $territory->id]);
	}
}
