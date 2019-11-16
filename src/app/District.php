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
}
