@extends('layouts.app')

@section('title', 'Territories')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Territories</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="{{ route('territories.create') }}" class="btn btn-primary" role="button"><span data-feather="plus"></span> Create</a>
		</div>
	</div>

	@include('layouts.success')

	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th>Territory</th>
					<th>District</th>
					<th>Region</th>
					<th>Assigned Users</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($territories as $territory)
				<tr>
					<td><a href="{{ route('territories.show', ['territory' => $territory->id]) }}">{{ $territory->name }}</a></td>
					<td><a href="{{ route('districts.show', ['district' => $territory->district->id]) }}">{{ $territory->district->name }}</a></td>
					<td><a href="{{ route('regions.show', ['region' => $territory->district->region->id]) }}">{{ $territory->district->region->name }}</a></td>
					<td>{{ $territory->getAssignedUsers()->implode('first_name', ', ') }}</td>
					<td>
						<a href="{{ route('territories.edit', ['territory' => $territory->id]) }}" class="btn btn-primary" role="button"><span data-feather="edit"></span> Edit</a>
						<form method="POST" action="{{ route('territories.destroy', ['territory' => $territory->id]) }}" style="display:inline;">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete {{ $territory->name }}?');"><span data-feather="trash-2"></span> Delete</button>
						</form>
					</td>
				</tr>
				@empty
					<td>No districts available. <a href="{{ route('territories.create') }}">Create one</a>!</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				@endforelse
			</tbody>
		</table>

		{{ $territories->links() }}
	</div>
@endsection
