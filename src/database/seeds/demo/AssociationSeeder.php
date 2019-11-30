<?php

namespace Seeds\Demo;

use App\Association;
use App\Customer;
use App\Territory;
use Illuminate\Database\Seeder;

class AssociationSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$territory = Territory::first();

		[$association] = factory('App\Association', 5)->create();
		$customer = factory('App\Customer')->create(['territory_id' => $territory->id]);

		$customer->addAssociation($association);
	}
}
