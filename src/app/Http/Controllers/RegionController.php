<?php

namespace App\Http\Controllers;

use App\Region;
use App\User;
use Illuminate\Http\Request;

class RegionController extends Controller {
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('can:view-regions');
		$this->middleware('can:create-regions')->only(['create', 'store']);
		$this->middleware('can:edit-regions')->only(['edit', 'update']);
		$this->middleware('can:destroy-regions')->only(['destroy']);
		$this->middleware('can:manage-region-user-assignments')->only(['addAssignedUser', 'removeAssignedUser']);
	}

	/**
	 * Display all regions
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$regions = Region::paginate(50);

		return view('customer-groupings.regions.index', compact('regions'));
	}

	/**
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('customer-groupings.regions.create');
	}

	/**
	 * Persist new region to DB
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$validatedData = $request->validate([
			'name' => 'required|string|max:255|unique:regions'
		]);

		$region = Region::create($validatedData);

		return redirect()->route('regions.index')->with('success', "Region \"$region->name\" added!");
	}

	/**
	 * Display a specific region
	 *
	 * @param Region $region
	 * @return \Illuminate\Http\Response
	 */
	public function show(Region $region) {
		return view('customer-groupings.regions.show', compact('region'));
	}

	/**
	 * @param Region $region
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Region $region) {
		$usersAvailableForAddAccess = User::all()->filter(function ($user) use ($region) {
			return !$region->getAssignedUsers()->contains('id', $user->id);
		});

		return view('customer-groupings.regions.edit', compact('region', 'usersAvailableForAddAccess'));
	}

	/**
	 * Persist updated region to DB
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param Region $region
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Region $region) {
		$validatedData = $request->validate([
			'name' => "required|string|max:255|unique:regions,name,{$region->id}"
		]);

		$modified = false;

		if ($validatedData['name'] !== $region->name) {
			$region->name = $validatedData['name'];
			$modified = true;
		}

		if ($modified) {
			$region->save();
		}

		return redirect()->route('regions.show', ['region' => $region->id])->with('success', 'Updated region!');
	}

	/**
	 * @param Region $region
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy(Region $region) {
		$region->delete();

		return redirect()->route('regions.index')->with('success', "Region \"$region->name\" deleted!");
	}

	/**
	 * Assign user to this region
	 *
	 * @param Request $request
	 * @param Region $region
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function addAssignedUser(Request $request, Region $region) {
		$validatedData = $request->validate([
			'user' => 'required|integer|max:18446744073709551615|exists:users,id'
		]);

		abort_unless($user = User::find($validatedData['user']), 404);

		$user->allow('access', $region);

		return redirect()->route('regions.edit', ['region' => $region->id])->with('success', "Assigned {$user->getDisplayName()} to this region.");
	}

	/**
	 * Unassign user from this region
	 *
	 * @param Region $region
	 * @param User $user
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function removeAssignedUser(Region $region, User $user) {
		$user->disallow('access', $region);

		return redirect()->route('regions.edit', ['region' => $region->id])->with('success', "Unassigned {$user->getDisplayName()} from this region.");
	}
}
