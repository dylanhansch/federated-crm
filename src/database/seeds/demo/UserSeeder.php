<?php

namespace Seeds\Demo;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		[$firstUser] = factory('App\User', 5)->create();

		$firstUser->assign('superadmin');
	}
}
