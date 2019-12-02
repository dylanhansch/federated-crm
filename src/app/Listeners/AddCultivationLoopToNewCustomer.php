<?php

namespace App\Listeners;

use App\CultivationLoop;
use App\CultivationLoopPhase;
use App\Events\NewCustomerEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddCultivationLoopToNewCustomer {
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param NewCustomerEvent $event
	 * @return void
	 */
	public function handle(NewCustomerEvent $event) {
		$phases = CultivationLoopPhase::where('name', 'Risk Control Review')
			->orWhere('name', 'Financial Protection Review')
			->orWhere('name', 'Annual Client Review')
			->orWhere('name', 'Client Continuation Plan')
			->get();

		foreach ($phases as $phase) {
			CultivationLoop::create([
				'customer_id' => $event->customer->id,
				'cultivation_loop_phase_id' => $phase->id,
				'due_date' => now(),
				'status' => 'NOT-STARTED'
			]);
		}
	}
}
