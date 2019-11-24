<?php

namespace App\Http\Controllers;

use App\Association;
use Illuminate\Http\Request;

class AssociationController extends Controller {
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('can:view-associations');
		$this->middleware('can:create-associations')->only(['create', 'store']);
		$this->middleware('can:edit-associations')->only(['edit', 'update']);
		$this->middleware('can:destroy-associations')->only(['destroy']);
	}

	/**
	 * Show all associations
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$associations = Association::paginate(50);

		return view('associations.index', compact('associations'));
	}

	/**
	 * Show form for creating an association
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('associations.create');
	}

	/**
	 * Persist new association to DB
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$validatedData = $request->validate([
			'name' => 'required|string|max:255|unique:associations'
		]);

		$association = Association::create($validatedData);

		return redirect()->route('associations.index')->with('success', "Created \"{$association->name}\"!");
	}

	/**
	 * Display association and any relevant details
	 *
	 * @param Association $association
	 * @return \Illuminate\Http\Response
	 */
	public function show(Association $association) {
		$customers = $association->customers()->paginate(50);

		return view('associations.show', compact('association', 'customers'));
	}

	/**
	 * Show the form for editing the specified association
	 *
	 * @param Association $association
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Association $association) {
		return view('associations.edit', compact('association'));
	}

	/**
	 * Persist updated association to DB
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param Association $association
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Association $association) {
		$validatedData = $request->validate([
			'name' => "required|string|max:255|unique:associations,name,{$association->id}"
		]);

		if ($validatedData['name'] !== $association->name) {
			$association->name = $validatedData['name'];
			$association->save();
		}

		return redirect()->route('associations.edit', ['association' => $association->id])->with('success', 'Updated!');
	}

	/**
	 * @param Association $association
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy(Association $association) {
		$association->delete();

		return redirect()->route('associations.index')->with('success', "Deleted \"{$association->name}\"");
	}
}
