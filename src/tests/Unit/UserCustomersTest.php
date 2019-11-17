<?php

namespace Tests\Unit;

use App\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCustomersTest extends TestCase {
	use RefreshDatabase;

	/** @test */
	public function customersListOnlyContainsCustomersThatUserHasAccessTo() {
		$region = factory('App\Region')->create();
		$district = factory('App\District')->create(['region_id' => $region->id]);
		[$territory, $otherTerritory] = factory('App\Territory', 2)->create(['district_id' => $district->id]);
		$userCustomers = factory('App\Customer', 5)->create(['territory_id' => $territory->id]);
		factory('App\Customer', 5)->create(['territory_id' => $otherTerritory->id]); // Other customers

		$user = factory('App\User')->create();
		$user->allow('access', $territory);

		$this->assertEquals($userCustomers->map(function ($customer) {
			return $customer->id;
		}), $user->customers()->map(function ($customer) {
			return $customer->id;
		}));
	}

	/** @test */
	public function customersListIsEmptyIfUserHasNoAccess() {
		$region = factory('App\Region')->create();
		$district = factory('App\District')->create(['region_id' => $region->id]);
		$territory = factory('App\Territory')->create(['district_id' => $district->id]);
		factory('App\Customer', 3)->create(['territory_id' => $territory->id]);

		$user = factory('App\User')->create();

		$this->assertCount(0, $user->customers());
	}

	/** @test */
	public function customerListIsEmptyIfUserHasIrrelevantAccess() {
		$region = factory('App\Region')->create();
		$district = factory('App\District')->create(['region_id' => $region->id]);
		$territory = factory('App\Territory')->create(['district_id' => $district->id]);
		factory('App\Customer', 3)->create(['territory_id' => $territory->id]);

		$user = factory('App\User')->create();
		$user->allow('some-random-permission', $territory);

		$this->assertCount(0, $user->customers());
	}

	/** @test */
	public function superadminCustomerListContainsAllCustomers() {
		$region = factory('App\Region')->create();
		$district = factory('App\District')->create(['region_id' => $region->id]);
		$territory = factory('App\Territory')->create(['district_id' => $district->id]);
		factory('App\Customer', 3)->create(['territory_id' => $territory->id]);

		$user = factory('App\User')->create();
		$user->assign('superadmin');

		$this->assertCount(Customer::all()->count(), $user->customers());
	}
}
