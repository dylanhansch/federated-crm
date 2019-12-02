<?php

namespace App\Events;

use App\Customer;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewCustomerEvent {
	use Dispatchable, SerializesModels;

	public $customer;

	/**
	 * Create a new event instance.
	 *
	 * @param Customer $customer
	 */
	public function __construct(Customer $customer) {
		$this->customer = $customer;
	}
}
