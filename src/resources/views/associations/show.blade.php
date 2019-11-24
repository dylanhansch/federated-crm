@extends('layouts.app')

@section('title', "Association: {$association->name}")

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Association: {{ $association->name }}</h1>
	</div>

	<h3>Customers Within This Association</h3>
	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<tbody>
				@forelse ($customers as $customer)
					<tr>
						<td><a href="{{ route('customers.show', ['customer' => $customer->id]) }}">{{ $customer->getDisplayName() }}</a></td>
					</tr>
				@empty
					<td>No customers are members of this association.</td>
				@endforelse
			</tbody>
		</table>

		{{ $customers->links() }}
	</div>
@endsection
