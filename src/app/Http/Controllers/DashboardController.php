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
		$user = User::find(auth()->user()->getAuthIdentifier());
		$cultivationStatuses = $user->getCultivationLoopStatus();

		return view('dashboard', compact('cultivationStatuses'));
	}
}
