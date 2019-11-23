@extends('layouts.app')

@section('title', 'Customers')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Customers</h1>
		@can('create-customers')
			<div class="btn-toolbar mb-2 mb-md-0">
				<a href="{{ route('customers.create') }}" class="btn btn-primary"><span data-feather="plus"></span> Add</a>
			</div>
		@endcan
	</div>

	@include('layouts.success')

	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th>Name</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($customers as $customer)
					<tr>
						<td><a href="{{ route('customers.show', ['customer' => $customer->id]) }}">{{ $customer->getDisplayName() }}</a></td>
						<td>
							<a href="{{ route('customers.edit', ['customer' => $customer->id]) }}" class="btn btn-primary">Edit</a>
							<form method="POST" action="{{ route('customers.destroy', ['customer' => $customer->id]) }}" style="display:inline;">
								@csrf
								@method('DELETE')
								<button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete {{ $customer->getDisplayName() }}?');">Delete</button>
							</form>
						</td>
					</tr>
				@empty
					<td>No customers. <a href="{{ route('customers.create') }}">Add one</a>!</td>
					<td></td>
				@endforelse
			</tbody>
		</table>

		{{ $customers->links() }}
	</div>
@endsection
