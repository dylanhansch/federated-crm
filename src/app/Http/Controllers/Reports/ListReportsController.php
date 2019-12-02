<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListReportsController extends Controller {
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('can:view-reports');
	}

	public function index() {
		return view('reports.index');
	}
}
