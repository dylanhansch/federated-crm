@extends('layouts.app')

@section('title', 'Add Customer')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Add Customer</h1>
	</div>

	<form method="POST" action="{{ route('customers.store') }}" role="form">
		@csrf

		<div class="row">
			<div class="col-lg-12">
				@include('layouts.success')
				@include('layouts.errors')

				<div class="form-group row">
					<div class="col-md-3">
						<label for="first_name">First Name: <span style="color: red">*</span></label>
						<input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" placeholder="Billy" value="{{ old('first_name') }}" required>
					</div>
					<div class="col-md-3">
						<label for="middle_name">Middle Name:</label>
						<input type="text" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" name="middle_name" id="middle_name" placeholder="Bob" value="{{ old('middle_name') }}">
					</div>
					<div class="col-md-3">
						<label for="last_name">Last Name: <span style="color: red">*</span></label>
						<input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="last_name" placeholder="Smith" value="{{ old('last_name') }}" required>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="company_name">Company Name:</label>
						<input type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" id="company_name" placeholder="Example Corp" value="{{ old('company_name') }}">
					</div>
					<div class="col-md-3">
						<label for="business_type">Business Type:</label>
						<input type="text" class="form-control{{ $errors->has('business_type') ? ' is-invalid' : '' }}" name="business_type" id="business_type" placeholder="Auto Supply" value="{{ old('business_type') }}">
					</div>
					<div class="col-md-3">
						<label for="website">Website:</label>
						<input type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website" id="website" placeholder="example.com" value="{{ old('website') }}">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="territory">Territory: <span style="color: red">*</span></label>
						<select class="form-control" name="territory_id" id="territory" required>
							@foreach ($territories as $territory)
								<option value="{{ $territory->id }}">{{ $territory->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label for="status">Customer Status: <span style="color: red">*</span></label>
						@php $statuses = ['CURRENT', 'PROSPECT', 'PREVIOUS'] @endphp
						<select class="form-control" name="status" id="status" required>
							@foreach ($statuses as $status)
								<option value="{{ $status }}">{{ ucwords(strtolower($status)) }}</option>
							@endforeach
						</select>
					</div>
				</div>


				<div class="row">
					<div class="col-lg-12">
						<h3>Primary Address</h3>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-4">
						<label for="street_address_1">Street: <span style="color: red">*</span></label>
						<input type="text" class="form-control{{ $errors->has('street_address_1') ? ' is-invalid' : '' }}" name="street_address_1" id="street_address_1" placeholder="123 Cool Business St." value="{{ old('street_address_1') }}" required>
					</div>
					<div class="col-md-4">
						<label for="street_address_2">Street 2:</label>
						<input type="text" class="form-control{{ $errors->has('street_address_2') ? ' is-invalid' : '' }}" name="street_address_2" id="street_address_2" placeholder="Suite 400" value="{{ old('street_address_2') }}">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="city">City/Town: <span style="color: red">*</span></label>
						<input type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" id="city" placeholder="Mankato" value="{{ old('city') }}" required>
					</div>
					<div class="col-md-3">
						<label for="subdivision">State/Subdivision: <span style="color: red">*</span></label>
						<input type="text" class="form-control{{ $errors->has('subdivision') ? ' is-invalid' : '' }}" name="subdivision" id="subdivision" placeholder="Minnesota" value="{{ old('subdivision') }}" required>
					</div>
					<div class="col-md-3">
						<label for="postal_code">Zip/Postal Code: <span style="color: red">*</span></label>
						<input type="text" class="form-control{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" name="postal_code" id="postal_code" placeholder="56001" value="{{ old('postal_code') }}" required>
					</div>
					<div class="col-md-3">
						<label for="country">Country: <span style="color: red">*</span></label>
						<input type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" id="country" placeholder="United States" value="{{ old('country') }}" required>
					</div>
				</div>


				<div class="row">
					<div class="col-lg-12">
						<h3>Primary Contact Information</h3>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="email">Email: <span style="color: red">*</span></label>
						<input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="billy.smith@example.com" value="{{ old('email') }}" required>
					</div>
					<div class="col-md-3">
						<label for="phone_number">Phone Number: <span style="color: red">*</span></label>
						<input type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" id="phone_number" placeholder="1-800-ASK-GARY" value="{{ old('phone_number') }}" required>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<button class="btn btn-primary" type="submit" name="add">Add</button>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
