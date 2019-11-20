<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('can:view-users');
		$this->middleware('can:create-users')->only(['create', 'store']);
		$this->middleware('can:edit-users')->only(['edit', 'update']);
		$this->middleware('can:destroy-users')->only(['destroy']);
	}

	/**
	 * Display listing of all users
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$users = User::paginate(50);

		return view('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a user
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('users.create');
	}

	/**
	 * Persist new user to DB
	 *
	 * TODO: Better phone number handling (set max to 255 in validator, strip out anything not matching [A-Za-z0-9], check size is at most 13, then persist that)
	 *
	 * TODO: Set user role(s)
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$validatedData = $request->validate([
			'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'phone_number' => 'required|string|max:13',
			'password' => 'required|string|confirmed|max:255'
		]);

		$user = User::create([
			'first_name' => $validatedData['first_name'],
			'last_name' => $validatedData['last_name'],
			'email' => $validatedData['email'],
			'phone_number' => $validatedData['phone_number'],
			'password' => Hash::make($validatedData['password'])
		]);

		return redirect()->route('users.index')->with('success', "Created \"{$user->getDisplayName()}\"");
	}

	/**
	 * Display the specified user
	 *
	 * @param User $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user) {
		// TODO
	}

	/**
	 * Show the form for editing the specified user
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user) {
		// TODO
	}

	/**
	 * Persist updated user to DB
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param User $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user) {
		// TODO
	}

	/**
	 * Delete user
	 *
	 * TODO: Need to make sure customer grouping assignments, other data created (like notes, etc.) that are linked to user are still displayed properly post-delete
	 *
	 * @param User $user
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function destroy(User $user) {
		$user->delete();

		return redirect()->route('users.index')->with('success', "Deleted \"{$user->getDisplayName()}\"");
	}
}
