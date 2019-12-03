@extends('layouts.app')

@section('title', 'Add Contact')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Add Additional Contact for {{ $customer->getDisplayName() }}</h1>
	</div>

	<form method="POST" action="{{ route('contacts.store', ['customer' => $customer->id]) }}" role="form">
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
						<label for="last_name">Last Name: <span style="color: red">*</span></label>
						<input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="last_name" placeholder="Smith" value="{{ old('last_name') }}" required>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="email">Email:</label>
						<input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="billy.smith@example.com" value="{{ old('email') }}">
					</div>
					<div class="col-md-3">
						<label for="phone_number">Phone Number:</label>
						<input type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" id="phone_number" placeholder="1-800-ASK-GARY" value="{{ old('phone_number') }}">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="type">Contact Type: <span style="color: red">*</span></label>
						<input type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" id="type" placeholder="Secretary" value="{{ old('type') }}" required>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="birth_date">Birthday:</label>
						<input type="date" class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" name="birth_date" id="birth_date" value="{{ old('birth_date') }}">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<button class="btn btn-primary" type="submit" name="add"><span data-feather="plus"></span> Add</button>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
