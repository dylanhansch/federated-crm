<?php

namespace Seeds\Demo;

use App\Association;
use App\Customer;
use Illuminate\Database\Seeder;

class AssociationSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		[$association] = factory('App\Association', 5)->create();
		$customer = factory('App\Customer')->create();

		$customer->addAssociation($association);
	}
}
