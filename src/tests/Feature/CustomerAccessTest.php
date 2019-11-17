<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerAccessTest extends TestCase {
	use RefreshDatabase;

	/** @test */
	public function userCanAccessCustomersInTheirTerritory() {
		$user = factory('App\User')->create();
		$region = factory('App\Region')->create();
		$district = factory('App\District')->create(['region_id' => $region->id]);
		$territory = factory('App\Territory')->create(['district_id' => $district->id]);

		$user->allow('access', $territory);

		$customer = factory('App\Customer')->create(['territory_id' => $territory->id]);

		$this->assertTrue($user->can('access-customer', $customer));
	}

	/** @test */
	public function userCanAccessCustomersInTheirDistrict() {
		$user = factory('App\User')->create();
		$region = factory('App\Region')->create();
		$district = factory('App\District')->create(['region_id' => $region->id]);
		$territory = factory('App\Territory')->create(['district_id' => $district->id]);

		$user->allow('access', $district);

		$customer = factory('App\Customer')->create(['territory_id' => $territory->id]);

		$this->assertTrue($user->can('access-customer', $customer));
	}

	/** @test */
	public function userCanAccessCustomersInTheirRegion() {
		$user = factory('App\User')->create();
		$region = factory('App\Region')->create();
		$district = factory('App\District')->create(['region_id' => $region->id]);
		$territory = factory('App\Territory')->create(['district_id' => $district->id]);

		$user->allow('access', $region);

		$customer = factory('App\Customer')->create(['territory_id' => $territory->id]);

		$this->assertTrue($user->can('access-customer', $customer));
	}

	/** @test */
	public function userCannotAccessCustomersOutsideOfTheirTerritory() {
		$user = factory('App\User')->create();
		$region = factory('App\Region')->create();
		$district = factory('App\District')->create(['region_id' => $region->id]);
		[$territory, $otherTerritory] = factory('App\Territory', 2)->create(['district_id' => $district->id]);

		$user->allow('access', $territory);

		$customer = factory('App\Customer')->create(['territory_id' => $otherTerritory->id]);

		$this->assertFalse($user->can('access-customer', $customer));
	}

	/** @test */
	public function userCannotAccessCustomersOutsideOfTheirDistrict() {
		$user = factory('App\User')->create();
		$region = factory('App\Region')->create();
		[$district, $otherDistrict] = factory('App\District', 2)->create(['region_id' => $region->id]);
		$otherTerritory = factory('App\Territory')->create(['district_id' => $otherDistrict->id]);

		$user->allow('access', $district);

		$customer = factory('App\Customer')->create(['territory_id' => $otherTerritory->id]);

		$this->assertFalse($user->can('access-customer', $customer));
	}

	/** @test */
	public function userCannotAccessCustomersOutsideOfTheirRegion() {
		$user = factory('App\User')->create();
		[$region, $otherRegion] = factory('App\Region', 2)->create();
		$otherDistrict = factory('App\District')->create(['region_id' => $otherRegion->id]);
		$otherTerritory = factory('App\Territory')->create(['district_id' => $otherDistrict->id]);

		$user->allow('access', $region);

		$customer = factory('App\Customer')->create(['territory_id' => $otherTerritory->id]);

		$this->assertFalse($user->can('access-customer', $customer));
	}
}
