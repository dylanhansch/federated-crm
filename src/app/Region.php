<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {
	/**
	 * The attributes that are NOT mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [
		'id'
	];

	/**
	 * Districts within this region
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function districts() {
		return $this->hasMany('App\District');
	}

	/**
	 * Users who are explicitly assigned to this region
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function getAssignedUsers() {
		return User::join('permissions', 'users.id', '=', 'permissions.entity_id')
			->join('abilities', 'abilities.id', '=', 'permissions.ability_id')
			->where('permissions.entity_type', 'App\User')
			->where('abilities.name', 'access')
			->where('abilities.entity_id', $this->id)
			->where('abilities.entity_type', 'App\Region')
			->select('users.*')
			->get();
	}
}
