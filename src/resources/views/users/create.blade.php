@extends('layouts.app')

@section('title', 'Create User')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Create User</h1>
	</div>

	<form method="POST" action="{{ route('users.store') }}" role="form">
		@csrf

		<div class="row">
			<div class="col-lg-12">
				@include('layouts.errors')

				<div class="form-group row">
					<div class="col-md-3">
						<label for="first_name">First Name:</label>
						<input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" placeholder="Billy" value="{{ old('first_name') }}">
					</div>
					<div class="col-md-3">
						<label for="last_name">Last Name:</label>
						<input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="last_name" placeholder="Smith" value="{{ old('last_name') }}">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="email">Email:</label>
						<input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="billy.smith@federatedinsurance.com" value="{{ old('email') }}">
					</div>
					<div class="col-md-3">
						<label for="phone_number">Phone Number:</label>
						<input type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" id="phone_number" placeholder="1-800-ASK-GARY" value="{{ old('phone_number') }}">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="password">Password:</label>
						<input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password">
					</div>
					<div class="col-md-3">
						<label for="password_confirmation">Confirm Password:</label>
						<input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" id="password_confirmation">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<button class="btn btn-primary" type="submit" name="create">Create</button>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
