<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerGroupingUserListTest extends TestCase {
	use RefreshDatabase;

	/** @test */
	public function regionUsersList() {
		[$region, $otherRegion] = factory('App\Region', 2)->create();
		$users = factory('App\User', 5)->create();
		$otherUsers = factory('App\User', 5)->create();
		factory('App\User', 5)->create(); // Users with no perms at all

		foreach ($users as $user) {
			$user->allow('access', $region);
		}

		foreach ($otherUsers as $user) {
			$user->allow('access', $otherRegion);
		}

		$this->assertEquals($users->map(function ($user) {
			return $user->id;
		})->collect(), $region->getAssignedUsers()->map(function ($user) {
			return $user->id;
		})->collect());
	}

	/** @test */
	public function districtUsersList() {
		$region = factory('App\Region')->create();
		[$district, $otherDistrict] = factory('App\District', 2)->create(['region_id' => $region->id]);
		$users = factory('App\User', 5)->create();
		$otherUsers = factory('App\User', 5)->create();
		factory('App\User', 5)->create(); // Users with no perms at all

		foreach ($users as $user) {
			$user->allow('access', $district);
		}

		foreach ($otherUsers as $user) {
			$user->allow('access', $otherDistrict);
		}

		$this->assertEquals($users->map(function ($user) {
			return $user->id;
		})->collect(), $district->getAssignedUsers()->map(function ($user) {
			return $user->id;
		})->collect());
	}

	/** @test */
	public function territoryUsersList() {
		$region = factory('App\Region')->create();
		$district = factory('App\District')->create(['region_id' => $region->id]);
		[$territory, $otherTerritory] = factory('App\Territory', 2)->create(['district_id' => $district->id]);
		$users = factory('App\User', 5)->create();
		$otherUsers = factory('App\User', 5)->create();
		factory('App\User', 5)->create(); // Users with no perms at all

		foreach ($users as $user) {
			$user->allow('access', $territory);
		}

		foreach ($otherUsers as $user) {
			$user->allow('access', $otherTerritory);
		}

		$this->assertEquals($users->map(function ($user) {
			return $user->id;
		})->collect(), $territory->getAssignedUsers()->map(function ($user) {
			return $user->id;
		})->collect());
	}
}
