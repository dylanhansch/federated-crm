<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Territory;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$customers = $this->getCustomersUserHasAccessTo(auth()->user());

		return view('customers.index', compact('customers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$territories = auth()->user()->isA('superadmin') ? Territory::all() : auth()->user()->getTerritories();

		return view('customers.create', compact('territories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$requestData = $request->all();

		if (array_key_exists('phone_number', $requestData)) {
			$requestData['phone_number'] = preg_replace('/[^A-Za-z0-9]/', '', $requestData['phone_number']);
		}

		$validator = Validator::make($requestData, [
			'territory_id' => 'required|exists:territories,id',
			'first_name' => 'required|string|max:255',
			'middle_name' => 'nullable|string|max:255',
			'last_name' => 'required|string|max:255',
			'email' => 'required|string|max:255',
			'phone_number' => 'required|string|max:13',
			'company_name' => 'nullable|string|max:255',
			'business_type' => 'nullable|string|max:255',
			'website' => 'nullable|string|max:255',
			'status' => 'required|string|max:255|in:CURRENT,PROSPECT,PREVIOUS',
			'street_address_1' => 'required|string|max:255',
			'street_address_2' => 'nullable|string|max:255',
			'city' => 'required|string|max:255',
			'subdivision' => 'required|string|max:255',
			'postal_code' => 'required|string|max:10',
			'country' => 'required|string|max:255'
		]);

		if ($validator->fails()) {
			return redirect()->route('customers.create')
				->withErrors($validator)
				->withInput();
		}

		$customer = Customer::create([
			'territory_id' => $requestData['territory_id'],
			'first_name' => $requestData['first_name'],
			'middle_name' => $requestData['middle_name'],
			'last_name' => $requestData['last_name'],
			'email' => $requestData['email'],
			'phone_number' => $requestData['phone_number'],
			'company_name' => $requestData['company_name'],
			'business_type' => $requestData['business_type'],
			'website' => $requestData['website'],
			'status' => $requestData['status'],
			'street_address_1' => $requestData['street_address_1'],
			'street_address_2' => $requestData['street_address_2'],
			'city' => $requestData['city'],
			'subdivision' => $requestData['subdivision'],
			'postal_code' => $requestData['postal_code'],
			'country' => $requestData['country']
		]);

		return redirect()->route('customers.index')->with('success', "Created \"{$customer->getDisplayName()}\"");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Customer $customer
	 * @return \Illuminate\Http\Response
	 */
	public function show(Customer $customer) {
		return view('customers.show', compact('customer'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Customer $customer
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Customer $customer) {
		$territories = auth()->user()->isA('superadmin') ? Territory::all() : auth()->user()->getTerritories();

		return view('customers.edit', compact('customer', 'territories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param Customer $customer
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Customer $customer) {
		$requestData = $request->all();

		if (array_key_exists('phone_number', $requestData)) {
			$requestData['phone_number'] = preg_replace('/[^A-Za-z0-9]/', '', $requestData['phone_number']);
		}

		$validator = Validator::make($requestData, [
			'territory_id' => 'required|exists:territories,id',
			'first_name' => 'required|string|max:255',
			'middle_name' => 'nullable|string|max:255',
			'last_name' => 'required|string|max:255',
			'email' => 'required|string|max:255',
			'phone_number' => 'required|string|max:13',
			'company_name' => 'nullable|string|max:255',
			'business_type' => 'nullable|string|max:255',
			'website' => 'nullable|string|max:255',
			'status' => 'required|string|max:255|in:CURRENT,PROSPECT,PREVIOUS',
			'street_address_1' => 'required|string|max:255',
			'street_address_2' => 'nullable|string|max:255',
			'city' => 'required|string|max:255',
			'subdivision' => 'required|string|max:255',
			'postal_code' => 'required|string|max:10',
			'country' => 'required|string|max:255'
		]);

		if ($validator->fails()) {
			return redirect()->route('customers.edit', ['customer' => $customer->id])
				->withErrors($validator)
				->withInput();
		}

		$modified = false;

		$fields = [
			'territory_id',
			'first_name',
			'middle_name',
			'last_name',
			'email',
			'phone_number',
			'company_name',
			'business_type',
			'website',
			'status',
			'street_address_1',
			'street_address_2',
			'city',
			'subdivision',
			'postal_code',
			'country'
		];

		foreach ($fields as $field) {
			if ($requestData[$field] !== $customer->getAttribute($field)) {
				$customer->setAttribute($field, $requestData[$field]);
				$modified = true;
			}
		}

		if ($modified) {
			$customer->save();
		}

		return redirect()->route('customers.edit', ['customer' => $customer->id])->with('success', "Updated \"{$customer->getDisplayName()}\"");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Customer $customer
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
	public function destroy(Customer $customer) {
		$customer->delete();

		return redirect()->route('customers.index')->with('success', "Deleted \"{$customer->getDisplayName()}\"");
	}

	/**
	 * Paginated collection of customers that user has access to
	 *
	 * @param Authenticatable $user
	 * @return LengthAwarePaginator|\Illuminate\Support\Collection
	 */
	private function getCustomersUserHasAccessTo(Authenticatable $user) {
		abort_unless($user = User::find($user->getAuthIdentifier()), 403);

		$perPage = 50;

		if ($user->can('view-customers')) {
			return Customer::paginate($perPage);
		}

		// User doesn't have access to view all customers. Try showing customers user has explicit access to.
		$customers = $user->customers();

		$page = request()->input('page', 1);
		abort_unless(filter_var($page, FILTER_VALIDATE_INT), 404);

		$customers = new LengthAwarePaginator(
			$customers->forPage($page, $perPage), $customers->count(), $perPage, $page
		);

		$customers->withPath(request()->url());

		return $customers;
	}
}
