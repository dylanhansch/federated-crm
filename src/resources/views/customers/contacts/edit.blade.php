@extends('layouts.app')

@section('title', "Edit Contact: {$contact->getDisplayName()}")

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">
			Edit Contact: {{ $contact->getDisplayName() }}

			<a href="{{ route('contacts.show', ['customer' => $customer->id, 'contact' => $contact->id]) }}" class="btn btn-info" role="button"><span data-feather="eye"></span> View</a>
		</h1>
	</div>

	<form method="POST" action="{{ route('contacts.update', ['customer' => $customer->id, 'contact' => $contact->id]) }}" role="form">
		@csrf
		@method('PATCH')

		<div class="row">
			<div class="col-lg-12">
				@include('layouts.success')
				@include('layouts.errors')

				<div class="form-group row">
					<div class="col-md-3">
						<label for="first_name">First Name: <span style="color: red">*</span></label>
						<input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ $contact->first_name }}" required>
					</div>
					<div class="col-md-3">
						<label for="last_name">Last Name: <span style="color: red">*</span></label>
						<input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="last_name" value="{{ $contact->last_name }}" required>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="email">Email:</label>
						<input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ $contact->email  }}">
					</div>
					<div class="col-md-3">
						<label for="phone_number">Phone Number:</label>
						<input type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" id="phone_number" value="{{ $contact->phone_number }}">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="type">Contact Type: <span style="color: red">*</span></label>
						<input type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" id="type" value="{{ $contact->type }}" required>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="birth_date">Birthday:</label>
						<input type="date" class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" name="birth_date" id="birth_date" value="{{ $contact->birth_date }}">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<button class="btn btn-primary" type="submit" name="save"><span data-feather="save"></span> Save</button>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
