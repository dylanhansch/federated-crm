@extends('layouts.app')

@section('title', 'Regions')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Regions</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="{{ route('regions.create') }}" class="btn btn-primary"><span data-feather="plus"></span> Create</a>
		</div>
	</div>

	@include('layouts.success')

	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th>Region</th>
					<th>Assigned Users</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($regions as $region)
				<tr>
					<td><a href="{{ route('regions.show', ['region' => $region->id]) }}">{{ $region->name }}</a></td>
					<td>{{ $region->getAssignedUsers()->implode('first_name', ', ') }}</td>
					<td>
						<a href="{{ route('regions.edit', ['region' => $region->id]) }}" class="btn btn-primary">Edit</a>
						<form method="POST" action="{{ route('regions.destroy', ['region' => $region->id]) }}" style="display:inline;">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete {{ $region->name }}?');">Delete</button>
						</form>
					</td>
				</tr>
				@empty
					<td>No regions available. <a href="{{ route('regions.create') }}">Create one</a>!</td>
					<td></td>
					<td></td>
				@endforelse
			</tbody>
		</table>

		{{ $regions->links() }}
	</div>
@endsection
