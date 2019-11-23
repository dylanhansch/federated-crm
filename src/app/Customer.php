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

	/**
	 * Customer's display name. Format: first_name last_name (company name if applicable)
	 *
	 * @return string
	 */
	public function getDisplayName() {
		$displayName = "{$this->first_name} {$this->last_name}";

		if ($this->company_name !== null && $this->company_name !== '') {
			$displayName .= " ({$this->company_name})";
		}

		return $displayName;
	}
}
