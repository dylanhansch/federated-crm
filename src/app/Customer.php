<?php

namespace App;

use App\Events\NewCustomerEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model {
	/**
	 * The attributes that are NOT mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [
		'id'
	];

	protected $dispatchesEvents = [
		'created' => NewCustomerEvent::class
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
	 * Associations that this customer belongs to
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function associations() {
		return $this->belongsToMany('App\Association', 'customer_associations');
	}

	/**
	 * Cultivation loop steps that are currently assigned to this customer/are tracked for this customer
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cultivationLoops() {
		return $this->hasMany('App\CultivationLoop');
	}

	/**
	 * Contacts that are associated with this customer
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function contacts() {
		return $this->hasMany('App\CustomerContact');
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

	/**
	 * @param Association $association
	 */
	public function addAssociation(Association $association) {
		if ($this->isMemberOfAssociation($association)) {
			return;
		}

		DB::table('customer_associations')->insert([
			'association_id' => $association->id,
			'customer_id' => $this->id
		]);
	}

	/**
	 * @param Association $association
	 */
	public function removeAssociation(Association $association) {
		DB::table('customer_associations')->where([
			'association_id' => $association->id,
			'customer_id' => $this->id
		])->delete();
	}

	/**
	 * @param Association $association
	 * @return bool
	 */
	public function isMemberOfAssociation(Association $association) {
		return DB::table('customer_associations')->where([
			'association_id' => $association->id,
			'customer_id' => $this->id
		])->exists();
	}
}
