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
}
