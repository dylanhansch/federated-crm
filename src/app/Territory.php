<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Territory extends Model {
	/**
	 * The attributes that are NOT mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [
		'id'
	];

	/**
	 * District this territory is within
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function district() {
		return $this->belongsTo('App\District');
	}

	/**
	 * Customers within this territory
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function customers() {
		return $this->hasMany('App\Customer');
	}

	/**
	 * Users who are explicitly assigned to this territory
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function getAssignedUsers() {
		return User::join('permissions', 'users.id', '=', 'permissions.entity_id')
			->join('abilities', 'abilities.id', '=', 'permissions.ability_id')
			->where('permissions.entity_type', 'App\User')
			->where('abilities.name', 'access')
			->where('abilities.entity_id', $this->id)
			->where('abilities.entity_type', 'App\Territory')
			->select('users.*')
			->get();
	}
}
