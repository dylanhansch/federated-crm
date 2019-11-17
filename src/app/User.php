<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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
	 * Customers that user has access to (likely is responsible for working with in some capacity)
	 *
	 * TODO: Can likely optimize this a lot - maybe a better query
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function customers() {
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
