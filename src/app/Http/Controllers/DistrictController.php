<?php

namespace App\Http\Controllers;

use App\District;
use App\Region;
use App\User;
use Illuminate\Http\Request;

class DistrictController extends Controller {
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('can:view-districts');
		$this->middleware('can:create-districts')->only(['create', 'store']);
		$this->middleware('can:edit-districts')->only(['edit', 'update']);
		$this->middleware('can:destroy-districts')->only(['destroy']);
		$this->middleware('can:manage-district-user-assignments')->only(['addAssignedUser', 'removeAssignedUser']);
	}

	/**
	 * Display all districts
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$districts = District::paginate(50);

		return view('customer-groupings.districts.index', compact('districts'));
	}

	/**
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$regions = Region::all();

		return view('customer-groupings.districts.create', compact('regions'));
	}

	/**
	 * Persist new district to DB
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$validatedData = $request->validate([
			'name' => 'required|string|max:255|unique:districts',
			'region_id' => 'required|integer|max:18446744073709551615|exists:regions,id'
		]);

		$district = District::create($validatedData);

		return redirect()->route('districts.index')->with('success', "District \"$district->name\" added!");
	}

	/**
	 * Display a specific district
	 *
	 * @param District $district
	 * @return \Illuminate\Http\Response
	 */
	public function show(District $district) {
		return view('customer-groupings.districts.show', compact('district'));
	}

	/**
	 * @param District $district
	 * @return \Illuminate\Http\Response
	 */
	public function edit(District $district) {
		$regions = Region::all();

		$usersAvailableForAddAccess = User::all()->filter(function ($user) use ($district) {
			return !$district->getAssignedUsers()->contains('id', $user->id);
		});

		return view('customer-groupings.districts.edit', compact('district', 'regions', 'usersAvailableForAddAccess'));
	}

	/**
	 * Persist updated district to DB
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param District $district
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, District $district) {
		$validatedData = $request->validate([
			'name' => "required|string|max:255|unique:districts,name,{$district->id}",
			'region_id' => 'required|integer|max:18446744073709551615|exists:regions,id'
		]);

		$modified = false;

		if ($validatedData['name'] !== $district->name) {
			$district->name = $validatedData['name'];
			$modified = true;
		}

		if ($validatedData['region_id'] !== $district->region_id) {
			$district->region_id = $validatedData['region_id'];
			$modified = true;
		}

		if ($modified) {
			$district->save();
		}

		return redirect()->route('districts.show', ['district' => $district->id])->with('success', 'Updated district!');
	}

	/**
	 * @param District $district
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy(District $district) {
		$district->delete();

		return redirect()->route('districts.index')->with('success', "District \"$district->name\" deleted!");
	}

	/**
	 * Assign user to this district
	 *
	 * @param Request $request
	 * @param District $district
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function addAssignedUser(Request $request, District $district) {
		$validatedData = $request->validate([
			'user' => 'required|integer|max:18446744073709551615|exists:users,id'
		]);

		abort_unless($user = User::find($validatedData['user']), 404);

		$user->allow('access', $district);

		return redirect()->route('districts.edit', ['district' => $district->id])->with('success', "Assigned {$user->getDisplayName()} to this district.");
	}

	/**
	 * Unassign user from this district
	 *
	 * @param District $district
	 * @param User $user
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function removeAssignedUser(District $district, User $user) {
		$user->disallow('access', $district);

		return redirect()->route('districts.edit', ['district' => $district->id])->with('success', "Unassigned {$user->getDisplayName()} from this district.");
	}
}
