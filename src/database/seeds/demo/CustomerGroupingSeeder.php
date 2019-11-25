<?php

namespace Seeds\Demo;

use Illuminate\Database\Seeder;

class CustomerGroupingSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		[$region] = factory('App\Region', 5)->create();
		[$district] = factory('App\District', 5)->create(['region_id' => $region->id]);
		[$territory1, $territory2] = factory('App\Territory', 5)->create(['district_id' => $district->id]);

		[$user1, $user2] = factory('App\User', 2)->create();
		$user1->allow('access', $territory1);
		$user2->allow('access', $territory2);
	}
}
