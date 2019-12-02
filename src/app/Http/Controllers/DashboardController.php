<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {
		// TODO: This garbage needs to be refactored

		$user = User::find(auth()->user()->getAuthIdentifier());
		$customers = $user->customers();

		$cultivationComplete = 0;
		$cultivationInProgress = 0;
		$cultivationNotStarted = 0;

		foreach ($customers as $customer) {
			$customer = Customer::find($customer->id);

			foreach ($customer->cultivationLoops as $loop) {
				switch ($loop->status) {
					case 'COMPLETE':
						$cultivationComplete++;
						break;
					case 'IN-PROGRESS':
						$cultivationInProgress++;
						break;
					case 'NOT-STARTED':
						$cultivationNotStarted++;
						break;
				}
			}
		}

		$total = $cultivationComplete + $cultivationInProgress + $cultivationNotStarted;

		$cultivationStatuses = [];

		if ($total != 0) {
			$cultivationStatuses = [
				[
					'label' => 'Not Started',
					'percentage' => ($cultivationNotStarted / $total) * 100,
					'color' => 'danger'
				],
				[
					'label' => 'In-Progress',
					'percentage' => ($cultivationInProgress / $total) * 100,
					'color' => 'warning'
				],
				[
					'label' => 'Complete',
					'percentage' => ($cultivationComplete / $total) * 100,
					'color' => 'success'
				]
			];
		}

		return view('dashboard', compact('cultivationStatuses'));
	}
}
