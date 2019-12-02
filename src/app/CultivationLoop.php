<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CultivationLoop extends Model {
	/**
	 * The attributes that are NOT mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [
		'id'
	];

	/**
	 * Customer this cultivation loop step belongs to
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function customer() {
		return $this->belongsTo('App\Customer');
	}

	/**
	 * Phase of the cultivation loop this step belongs to
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function phase() {
		return $this->belongsTo('App\CultivationLoopPhase', 'cultivation_loop_phase_id');
	}
}
