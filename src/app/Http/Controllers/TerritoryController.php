<?php

namespace App\Http\Controllers;

use App\District;
use App\Territory;
use App\User;
use Illuminate\Http\Request;

class TerritoryController extends Controller {
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('can:view-territories');
		$this->middleware('can:create-territories')->only(['create', 'store']);
		$this->middleware('can:edit-territories')->only(['edit', 'update']);
		$this->middleware('can:destroy-territories')->only(['destroy']);
		$this->middleware('can:manage-territory-user-assignments')->only(['addAssignedUser', 'removeAssignedUser']);
	}

	/**
	 * Display all territories
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$territories = Territory::paginate(50);

		return view('customer-groupings.territories.index', compact('territories'));
	}

	/**
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$districts = District::all();

		return view('customer-groupings.territories.create', compact('districts'));
	}

	/**
	 * Persist new territories to DB
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$validatedData = $request->validate([
			'name' => 'required|string|max:255|unique:territories',
			'district_id' => 'required|integer|max:18446744073709551615|exists:districts,id'
		]);

		$territory = Territory::create($validatedData);

		return redirect()->route('territories.index')->with('success', "Territory \"$territory->name\" added!");
	}

	/**
	 * Display a specific territory
	 *
	 * @param Territory $territory
	 * @return \Illuminate\Http\Response
	 */
	public function show(Territory $territory) {
		$customers = $territory->customers()->paginate(50);

		return view('customer-groupings.territories.show', compact('territory', 'customers'));
	}

	/**
	 * @param Territory $territory
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Territory $territory) {
		$districts = District::all();

		$usersAvailableForAddAccess = User::all()->filter(function ($user) use ($territory) {
			return !$territory->getAssignedUsers()->contains('id', $user->id);
		});

		return view('customer-groupings.territories.edit', compact('territory', 'districts', 'usersAvailableForAddAccess'));
	}

	/**
	 * Persist updated territory to DB
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param Territory $territory
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Territory $territory) {
		$validatedData = $request->validate([
			'name' => "required|string|max:255|unique:territories,name,{$territory->id}",
			'district_id' => 'required|integer|max:18446744073709551615|exists:districts,id'
		]);

		$modified = false;

		if ($validatedData['name'] !== $territory->name) {
			$territory->name = $validatedData['name'];
			$modified = true;
		}

		if ($validatedData['district_id'] !== $territory->district_id) {
			$territory->district_id = $validatedData['district_id'];
			$modified = true;
		}

		if ($modified) {
			$territory->save();
		}

		return redirect()->route('territories.show', ['territory' => $territory->id])->with('success', 'Updated territory!');
	}

	/**
	 * @param Territory $territory
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy(Territory $territory) {
		$territory->delete();

		return redirect()->route('territories.index')->with('success', "Territory \"$territory->name\" deleted!");
	}

	/**
	 * Assign user to this territory
	 *
	 * @param Request $request
	 * @param Territory $territory
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function addAssignedUser(Request $request, Territory $territory) {
		$validatedData = $request->validate([
			'user' => 'required|integer|max:18446744073709551615|exists:users,id'
		]);

		abort_unless($user = User::find($validatedData['user']), 404);

		$user->allow('access', $territory);

		return redirect()->route('territories.edit', ['territory' => $territory->id])->with('success', "Assigned {$user->getDisplayName()} to this territory.");
	}

	/**
	 * Unassign user from this territory
	 *
	 * @param Territory $territory
	 * @param User $user
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function removeAssignedUser(Territory $territory, User $user) {
		$user->disallow('access', $territory);

		return redirect()->route('territories.edit', ['territory' => $territory->id])->with('success', "Unassigned {$user->getDisplayName()} from this territory.");
	}
}
