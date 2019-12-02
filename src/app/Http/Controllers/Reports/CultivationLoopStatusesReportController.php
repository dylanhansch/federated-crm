<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class CultivationLoopStatusesReportController extends Controller {
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('can:view-cultivation-loop-statuses-report');
	}

	public function index() {
		$users = User::all();

		$users = $users->filter(function($user) {
			return $user->customers()->count() > 0;
		});

		return view('reports.cultivation-loop-statuses', compact('users'));
	}
}
