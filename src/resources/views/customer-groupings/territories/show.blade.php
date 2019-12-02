@extends('layouts.app')

@section('title', 'Territory: ' . $territory->name)

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Territory: {{ $territory->name }}</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="{{ route('territories.edit', ['territory' => $territory->id]) }}" class="btn btn-primary"><span data-feather="edit"></span> Edit</a>
		</div>
	</div>

	<h3>Customers Within This Territory</h3>
	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<tbody>
			@forelse ($customers as $customer)
				<tr>
					<td><a href="{{ route('customers.show', ['customer' => $customer->id]) }}">{{ $customer->getDisplayName() }}</a></td>
				</tr>
			@empty
				<td>No customers are within this territory.</td>
			@endforelse
			</tbody>
		</table>

		{{ $customers->links() }}
	</div>
@endsection
