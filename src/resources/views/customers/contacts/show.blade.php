@extends('layouts.app')

@section('title', "Contact: {$contact->getDisplayName()}")

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">
			Contact: {{ $contact->getDisplayName() }}

			<a href="{{ route('contacts.edit', ['customer' => $customer->id, 'contact' => $contact->id]) }}" class="btn btn-info" role="button"><span data-feather="edit"></span> Edit</a>
		</h1>
	</div>

	@include('layouts.success')

	<div class="row">
		<div class="col-md-3">
			<p><strong>First name: </strong> {{ $contact->first_name ?? 'n/a' }}</p>
		</div>
		<div class="col-md-3">
			<p><strong>Last name: </strong> {{ $contact->last_name ?? 'n/a' }}</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<p><strong>Email: </strong> <a href="mailto:{{ $contact->email }}">{{ $contact->email ?? 'n/a' }}</a></p>
		</div>
		<div class="col-md-3">
			<p><strong>Phone Number: </strong> <a href="tel:{{ $contact->phone_number }}">{{ $contact->phone_number ?? 'n/a' }}</a></p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<p><strong>Type: </strong> {{ $contact->type ?? 'n/a' }}</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<p><strong>Birthday: </strong> {{ $contact->birth_date ?? 'n/a' }}</p>
		</div>
	</div>
@endsection
