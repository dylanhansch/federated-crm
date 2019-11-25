<?php

use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$this->call([
			Seeds\Demo\BouncerSeeder::class,
			Seeds\Demo\UserSeeder::class,
			Seeds\Demo\CustomerGroupingSeeder::class,
			Seeds\Demo\CustomerSeeder::class,
			Seeds\Demo\AssociationSeeder::class
		]);
	}
}
