<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$user = User::create([
			'email' => 'admin@federatedinsurance.com',
			'first_name' => 'Admin',
			'last_name' => 'Admin',
			'phone_number' => '0001112222',
			'password' => bcrypt('default123'),
			'email_verified_at' => now(),
			'remember_token' => null
		]);

		$user->assign('superadmin');
	}
}
