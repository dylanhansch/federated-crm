@extends('layouts.app')

@section('title', "Customer: {$customer->getDisplayName()}")

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">
			Customer: {{ $customer->getDisplayName() }}

			<a href="{{ route('customers.edit', ['customer' => $customer->id]) }}" class="btn btn-info" role="button"><span data-feather="edit"></span> Edit</a>

			@if ($customer->status === 'CURRENT')
				<span class="badge badge-pill badge-success">Status: Current</span>
			@elseif ($customer->status === 'PREVIOUS')
				<span class="badge badge-pill badge-secondary">Status: Previous</span>
			@elseif ($customer->status === 'PROSPECT')
				<span class="badge badge-pill badge-warning">Status: Prospect</span>
			@endif

			<span class="badge badge-pill badge-primary">Territory: {{ $customer->territory->name }}</span>
		</h1>
	</div>

	<div class="row">
		<div class="col-md-3">
			<p><strong>First name: </strong> {{ $customer->first_name ?? 'n/a' }}</p>
		</div>
		<div class="col-md-3">
			<p><strong>Middle name: </strong> {{ $customer->middle_name ?? 'n/a' }}</p>
		</div>
		<div class="col-md-3">
			<p><strong>Last name: </strong> {{ $customer->last_name ?? 'n/a' }}</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<p><strong>Company name: </strong> {{ $customer->company_name ?? 'n/a' }}</p>
		</div>
		<div class="col-md-3">
			<p><strong>Business Type: </strong> {{ $customer->business_type ?? 'n/a' }}</p>
		</div>
		<div class="col-md-3">
			<p><strong>Website: </strong> <a href="{{ $customer->website ?? 'n/a' }}" target="_blank">{{ $customer->website }}</a></p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<p><strong>Association{{ $customer->associations->count() > 1 ? 's' : '' }}: </strong> {{ $customer->associations->count() > 0 ? $customer->associations->implode('name', ', ') : 'n/a' }}</p>
		</div>
	</div>

	<h3>Address</h3>
	<div class="row">
		<div class="col-md-3">
			<p><strong>Street Address 1: </strong> {{ $customer->street_address_1 ?? 'n/a' }}</p>
		</div>
		<div class="col-md-3">
			<p><strong>Street Address 2: </strong> {{ $customer->street_address_2 ?? 'n/a' }}</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<p><strong>City: </strong> {{ $customer->city ?? 'n/a' }}</p>
		</div>
		<div class="col-md-3">
			<p><strong>Subdivision: </strong> {{ $customer->subdivision ?? 'n/a' }}</p>
		</div>
		<div class="col-md-3">
			<p><strong>Postal Code: </strong> {{ $customer->postal_code ?? 'n/a' }}</p>
		</div>
		<div class="col-md-3">
			<p><strong>Country: </strong> {{ $customer->country ?? 'n/a' }}</p>
		</div>
	</div>

	<h3>Primary Contact Information</h3>
	<div class="row">
		<div class="col-md-3">
			<p><strong>Email: </strong> <a href="mailto:{{ $customer->email }}">{{ $customer->email ?? 'n/a' }}</a></p>
		</div>
		<div class="col-md-3">
			<p><strong>Phone Number: </strong> <a href="tel:{{ $customer->phone_number }}">{{ $customer->phone_number ?? 'n/a' }}</a></p>
		</div>
	</div>

	<h3>Cultivation Loop Status</h3>
	<div class="row">
		<div class="col-md-6">
			<ul class="list-group">
				@foreach ($customer->cultivationLoops as $cultivationLoop)
					@switch($cultivationLoop->status)
						@case('COMPLETE')
							@php $displayTag = 'success'; @endphp
							@break
						@case('IN-PROGRESS')
							@php $displayTag = 'warning'; @endphp
							@break
						@case('NOT-STARTED')
							@php $displayTag = 'danger'; @endphp
							@break
					@endswitch

					<li class="list-group-item list-group-item-{{ $displayTag }}">{{ $cultivationLoop->phase->name }}</li>
				@endforeach
			</ul>
		</div>
	</div>
@endsection
