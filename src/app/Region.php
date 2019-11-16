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
}
