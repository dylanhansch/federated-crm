<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCustomerGroupingsTest extends TestCase {
	use RefreshDatabase;

	/** @test */
	public function canGetListOfTerritoriesUserHasAccessTo() {
		$user = factory('App\User')->create();
		$region = factory('App\Region')->create();
		$district = factory('App\District')->create(['region_id' => $region->id]);
		[$userTerritory1, $userTerritory2] = factory('App\Territory', 3)->create(['district_id' => $district->id]);

		$user->allow('access', $userTerritory1);
		$user->allow('access', $userTerritory2);

		$this->assertEquals(
			[$userTerritory1->id, $userTerritory2->id],
			$user->getTerritories()->map(function ($territory) {
				return $territory->id;
			})->toArray()
		);
	}

	/** @test */
	public function canGetListOfDistrictsUserHasAccessTo() {
		$user = factory('App\User')->create();
		$region = factory('App\Region')->create();
		[$userDistrict1, $userDistrict2] = factory('App\District', 3)->create(['region_id' => $region->id]);

		$user->allow('access', $userDistrict1);
		$user->allow('access', $userDistrict2);

		$this->assertEquals(
			[$userDistrict1->id, $userDistrict2->id],
			$user->getDistricts()->map(function ($district) {
				return $district->id;
			})->toArray()
		);
	}

	/** @test */
	public function canGetListOfRegionsUserHasAccessTo() {
		$user = factory('App\User')->create();
		[$userRegion1, $userRegion2] = factory('App\Region', 3)->create();

		$user->allow('access', $userRegion1);
		$user->allow('access', $userRegion2);

		$this->assertEquals(
			[$userRegion1->id, $userRegion2->id],
			$user->getRegions()->map(function ($region) {
				return $region->id;
			})->toArray()
		);
	}
}
