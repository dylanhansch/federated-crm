<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerContactController extends Controller {
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('can:create-customer-contacts')->only(['create', 'store']);
		$this->middleware('can:edit-customer-contacts')->only(['edit', 'update']);
		$this->middleware('can:destroy-customer-contacts')->only(['destroy']);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param Customer $customer
	 * @return void
	 */
	public function create(Customer $customer) {
		return view('customers.contacts.create', compact('customer'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param Customer $customer
	 * @return void
	 */
	public function store(Request $request, Customer $customer) {
		$requestData = $request->except('add');

		if (array_key_exists('phone_number', $requestData) && $requestData['phone_number'] != '') {
			$requestData['phone_number'] = preg_replace('/[^A-Za-z0-9]/', '', $requestData['phone_number']);
		}

		$validator = Validator::make($requestData, [
			'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',
			'type' => 'required|string|max:255',
			'email' => 'nullable|string|max:255',
			'phone_number' => 'nullable|string|max:13',
			'birth_date' => 'nullable|date'
		]);

		if ($validator->fails()) {
			return redirect()->route('contacts.create', ['customer' => $customer->id])
				->withErrors($validator)
				->withInput();
		}

		$requestData['customer_id'] = $customer->id;

		$contact = CustomerContact::create($requestData);

		return redirect()->route('customers.show', ['customer' => $customer->id])->with('success', 'Added contact: ' . $contact->getDisplayName());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Customer $customer
	 * @param CustomerContact $contact
	 * @return void
	 */
	public function show(Customer $customer, CustomerContact $contact) {
		abort_unless($customer->id == $contact->customer_id, 404);

		return view('customers.contacts.show', compact('customer', 'contact'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Customer $customer
	 * @param CustomerContact $contact
	 * @return void
	 */
	public function edit(Customer $customer, CustomerContact $contact) {
		abort_unless($customer->id == $contact->customer_id, 404);

		return view('customers.contacts.edit', compact('customer', 'contact'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param Customer $customer
	 * @param CustomerContact $contact
	 * @return void
	 */
	public function update(Request $request, Customer $customer, CustomerContact $contact) {
		abort_unless($customer->id == $contact->customer_id, 404);

		$requestData = $request->all();

		if (array_key_exists('phone_number', $requestData) && $requestData['phone_number'] != '') {
			$requestData['phone_number'] = preg_replace('/[^A-Za-z0-9]/', '', $requestData['phone_number']);
		}

		$validator = Validator::make($requestData, [
			'first_name' => 'required|string|max:255',
			'last_name' => 'required|string|max:255',
			'type' => 'required|string|max:255',
			'email' => 'nullable|string|max:255',
			'phone_number' => 'nullable|string|max:13',
			'birth_date' => 'nullable|date'
		]);

		if ($validator->fails()) {
			return redirect()->route('contacts.edit', ['customer' => $customer->id, 'contact' => $contact->id])
				->withErrors($validator)
				->withInput();
		}

		$modified = false;

		$fields = [
			'first_name',
			'last_name',
			'type',
			'email',
			'phone_number',
			'birth_date'
		];

		foreach ($fields as $field) {
			if ($requestData[$field] !== $contact->getAttribute($field)) {
				$contact->setAttribute($field, $requestData[$field]);
				$modified = true;
			}
		}

		if ($modified) {
			$contact->save();
		}

		return redirect()->route('contacts.edit', ['customer' => $customer->id, 'contact' => $contact->id])->with('success', 'Updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Customer $customer
	 * @param CustomerContact $contact
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function destroy(Customer $customer, CustomerContact $contact) {
		abort_unless($customer->id == $contact->customer_id, 404);

		$contact->delete();

		return redirect()->route('customers.show', ['customer' => $customer->id])->with('success', 'Deleted ' . $contact->getDisplayName());
	}
}
