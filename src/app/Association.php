<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Association extends Model {
	/**
	 * The attributes that are NOT mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [
		'id'
	];

	/**
	 * Customers within this association
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function customers() {
		return $this->belongsToMany('App\Customer', 'customer_associations');
	}
}
