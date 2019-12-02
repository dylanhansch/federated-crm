<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable {
	use HasRolesAndAbilities, Notifiable;

	/**
	 * The attributes that are NOT mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [
		'id'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	/**
	 * User's display name (first_name last_name)
	 *
	 * @return string
	 */
	public function getDisplayName(): string {
		return "{$this->first_name} {$this->last_name}";
	}

	/**
	 * @param string $password
	 */
	public function changePassword(string $password): void {
		$this->password = Hash::make($password);
		$this->save();
	}

	/**
	 * Get all territories that user has explicit access to
	 *
	 * @return mixed
	 */
	public function getTerritories() {
		return Territory::join('abilities', 'territories.id', '=', 'abilities.entity_id')
			->join('permissions', 'permissions.ability_id', '=', 'abilities.id')
			->where('permissions.entity_type', 'App\User')
			->where('permissions.entity_id', $this->id)
			->where('abilities.name', 'access')
			->where('abilities.entity_type', 'App\Territory')
			->select('territories.*')
			->get();
	}

	/**
	 * Get all districts that user has explicit access to
	 *
	 * @return mixed
	 */
	public function getDistricts() {
		return District::join('abilities', 'districts.id', '=', 'abilities.entity_id')
			->join('permissions', 'permissions.ability_id', '=', 'abilities.id')
			->where('permissions.entity_type', 'App\User')
			->where('permissions.entity_id', $this->id)
			->where('abilities.name', 'access')
			->where('abilities.entity_type', 'App\District')
			->select('districts.*')
			->get();
	}

	/**
	 * Get all regions that user has explicit access to
	 *
	 * @return mixed
	 */
	public function getRegions() {
		return Region::join('abilities', 'regions.id', '=', 'abilities.entity_id')
			->join('permissions', 'permissions.ability_id', '=', 'abilities.id')
			->where('permissions.entity_type', 'App\User')
			->where('permissions.entity_id', $this->id)
			->where('abilities.name', 'access')
			->where('abilities.entity_type', 'App\Region')
			->select('regions.*')
			->get();
	}

	/**
	 * Get an array containing the percentage completion (of each stage [complete, in-progress, not-started])
	 * of all of user's cultivation loops.
	 *
	 * TODO: This really should be refactored - it's garbage
	 *
	 * @return array
	 */
	public function getCultivationLoopStatus() {
		$customers = $this->customers();

		$cultivationComplete = 0;
		$cultivationInProgress = 0;
		$cultivationNotStarted = 0;

		foreach ($customers as $customer) {
			$customer = Customer::find($customer->id);

			foreach ($customer->cultivationLoops as $loop) {
				switch ($loop->status) {
					case 'COMPLETE':
						$cultivationComplete++;
						break;
					case 'IN-PROGRESS':
						$cultivationInProgress++;
						break;
					case 'NOT-STARTED':
						$cultivationNotStarted++;
						break;
				}
			}
		}

		$total = $cultivationComplete + $cultivationInProgress + $cultivationNotStarted;

		$cultivationStatuses = [];

		if ($total != 0) {
			$cultivationStatuses = [
				[
					'label' => 'Not Started',
					'percentage' => ($cultivationNotStarted / $total) * 100,
					'color' => 'danger'
				],
				[
					'label' => 'In-Progress',
					'percentage' => ($cultivationInProgress / $total) * 100,
					'color' => 'warning'
				],
				[
					'label' => 'Complete',
					'percentage' => ($cultivationComplete / $total) * 100,
					'color' => 'success'
				]
			];
		}

		return $cultivationStatuses;
	}

	/**
	 * Customers that user has access to (likely is responsible for working with in some capacity)
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function customers() {
		if ($this->isA('superadmin')) {
			return Customer::all();
		}

		$customers = [];

		$permissions = DB::table('permissions')
			->leftJoin('abilities', 'permissions.ability_id', '=', 'abilities.id')
			->where('abilities.name', 'access')
			->where('permissions.entity_id', '=', $this->id)
			->where('permissions.entity_type', '=', 'App\User')
			->get();

		$regions = [];
		$districts = [];
		$territories = [];

		foreach ($permissions as $permission) {
			switch ($permission->entity_type) {
				case "App\Region":
					$regions[] = $permission->entity_id;
					break;
				case "App\District":
					$districts[] = $permission->entity_id;
					break;
				case "App\Territory":
					$territories[] = $permission->entity_id;
					break;
			}
		}

		foreach ($regions as $region_id) {
			$region = Region::find($region_id);

			if ($region == null) {
				continue;
			}

			foreach ($region->districts as $district) {
				foreach ($district->territories as $territory) {
					foreach ($territory->customers as $customer) {
						$customers[] = $customer;
					}
				}
			}
		}

		foreach ($districts as $district_id) {
			$district = District::find($district_id);

			if ($district == null) {
				continue;
			}

			foreach ($district->territories as $territory) {
				foreach ($territory->customers as $customer) {
					$customers[] = $customer;
				}
			}
		}

		foreach ($territories as $territory_id) {
			$territory = Territory::find($territory_id);

			if ($territory == null) {
				continue;
			}

			foreach ($territory->customers as $customer) {
				$customers[] = $customer;
			}
		}

		$customers = collect($customers)->unique('id');

		return $customers;
	}
}
