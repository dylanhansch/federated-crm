<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model {
	/**
	 * The attributes that are NOT mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [
		'id'
	];

	/**
	 * Customer that this contact belongs to / is associated with
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function customer() {
		return $this->belongsTo('App\Customer');
	}

	/**
	 * Display name for contact (format: first_name last_name)
	 *
	 * @return string
	 */
	public function getDisplayName() {
		return "{$this->first_name} {$this->last_name}";
	}
}
