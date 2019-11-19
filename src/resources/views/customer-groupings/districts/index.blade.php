@extends('layouts.app')

@section('title', 'Districts')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Districts</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="{{ route('districts.create') }}" class="btn btn-primary"><span data-feather="plus"></span> Create</a>
		</div>
	</div>

	@include('layouts.success')

	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th>District</th>
					<th>Region</th>
					<th>Assigned Users</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($districts as $district)
				<tr>
					<td><a href="{{ route('districts.show', ['district' => $district->id]) }}">{{ $district->name }}</a></td>
					<td><a href="{{ route('regions.show', ['region' => $district->region->id]) }}">{{ $district->region->name }}</a></td>
					<td>{{ $district->getAssignedUsers()->implode('first_name', ', ') }}</td>
					<td>
						<a href="{{ route('districts.edit', ['district' => $district->id]) }}" class="btn btn-primary">Edit</a>
						<form method="POST" action="{{ route('districts.destroy', ['district' => $district->id]) }}" style="display:inline;">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete {{ $district->name }}?');">Delete</button>
						</form>
					</td>
				</tr>
				@empty
					<td>No districts available. <a href="{{ route('districts.create') }}">Create one</a>!</td>
					<td></td>
					<td></td>
					<td></td>
				@endforelse
			</tbody>
		</table>

		{{ $districts->links() }}
	</div>
@endsection
