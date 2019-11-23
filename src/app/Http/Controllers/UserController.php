<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
		$roles = DB::table('roles')->get();

		return view('users.create', compact('roles'));
	}

	/**
	 * Persist new user to DB
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$requestData = $request->all();

		$validator = Validator::make($requestData, [
			'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'phone_number' => 'required|string',
			'password' => 'required|string|confirmed|max:255',
			'roles[]' => 'nullable|string|max:255'
		]);

		$requestData['phone_number'] = preg_replace('/[^A-Za-z0-9]/', '', $requestData['phone_number']);

		$validator->after(function ($validator) use ($requestData) {
			if (strlen($requestData['phone_number']) > 13) {
				$validator->errors()->add('phone_number', 'Phone number must be 13 digits or less (minus any special characters).');
			}
		});

		if ($validator->fails()) {
			return redirect()->route('users.create')
				->withErrors($validator)
				->withInput();
		}

		$user = User::create([
			'first_name' => $requestData['first_name'],
			'last_name' => $requestData['last_name'],
			'email' => $requestData['email'],
			'phone_number' => $requestData['phone_number'],
			'password' => Hash::make($requestData['password'])
		]);

		$roles = DB::table('roles')->get();
		foreach ($roles as $role) {
			$role = $role->name;
			if (isset($requestData['roles']) && in_array($role, $requestData['roles'])) {
				$user->assign($role);
			}
		}

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
	 * @param User $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user) {
		$this->superadminProtect($user);

		$roles = DB::table('roles')->get();

		return view('users.edit', compact('user', 'roles'));
	}

	/**
	 * Persist updated user to DB
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param User $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user) {
		$this->superadminProtect($user);

		$requestData = $request->all();

		$validator = Validator::make($requestData, [
			'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',
			'email' => "required|string|email|max:255|unique:users,email,{$user->id}",
			'phone_number' => 'required|string',
			'password' => 'nullable|string|confirmed|max:255',
			'roles[]' => 'nullable|string|max:255'
		]);

		$requestData['phone_number'] = preg_replace('/[^A-Za-z0-9]/', '', $requestData['phone_number']);

		$validator->after(function ($validator) use ($requestData) {
			if (strlen($requestData['phone_number']) > 13) {
				$validator->errors()->add('phone_number', 'Phone number must be 13 digits or less (minus any special characters).');
			}
		});

		if ($validator->fails()) {
			return redirect()->route('users.edit', ['user' => $user->id])
				->withErrors($validator)
				->withInput();
		}

		$modified = false;

		$fields = [
			'first_name',
			'last_name',
			'email',
			'phone_number'
		];

		foreach ($fields as $field) {
			if ($requestData[$field] !== $user->getAttribute($field)) {
				$user->setAttribute($field, $requestData[$field]);
				$modified = true;
			}
		}

		if ($modified) {
			$user->save();
		}

		if ($requestData['password'] !== null && $requestData['password'] !== '') {
			$user->changePassword($requestData['password']);
		}

		$roles = DB::table('roles')->get();
		foreach ($roles as $role) {
			$role = $role->name;
			if (!isset($requestData['roles'])) {
				$user->retract($role);
				continue;
			}
			if (in_array($role, $requestData['roles'])) {
				$user->assign($role);
			} else {
				$user->retract($role);
			}
		}

		return redirect()->route('users.edit', ['user' => $user->id])->with('success', "Saved changes.");
	}

	/**
	 * Delete user
	 *
	 * @param User $user
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function destroy(User $user) {
		$this->superadminProtect($user);

		$user->delete();

		return redirect()->route('users.index')->with('success', "Deleted \"{$user->getDisplayName()}\"");
	}

	/**
	 * Returns 403 error and page if current user is not a superadmin and is trying to manage a superadmin.
	 * @param User $user
	 */
	private function superadminProtect(User $user) {
		abort_if(auth()->user()->isNotA('superadmin') && $user->isA('superadmin'), 403, 'Only superadmins can manage superadmins.');
	}
}
