<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
	/**
	 * The attributes that are NOT mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [
		'id'
	];

	/**
	 * Territory this customer is within
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function territory() {
		return $this->belongsTo('App\Territory');
	}
}
