<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model {
	/**
	 * The attributes that are NOT mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [
		'id'
	];

	/**
	 * Region that this district is within
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function region() {
		return $this->belongsTo('App\Region');
	}

	/**
	 * Territories within this district
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function territories() {
		return $this->hasMany('App\Territory');
	}

	/**
	 * Users who are explicitly assigned to this district
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function getAssignedUsers() {
		return User::join('permissions', 'users.id', '=', 'permissions.entity_id')
			->join('abilities', 'abilities.id', '=', 'permissions.ability_id')
			->where('permissions.entity_type', 'App\User')
			->where('abilities.name', 'access')
			->where('abilities.entity_id', $this->id)
			->where('abilities.entity_type', 'App\District')
			->select('users.*')
			->get();
	}
}
