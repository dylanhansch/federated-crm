@extends('layouts.app')

@section('title', 'Users')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Users</h1>
		@can('create-users')
			<div class="btn-toolbar mb-2 mb-md-0">
				<a href="{{ route('users.create') }}" class="btn btn-primary"><span data-feather="plus"></span> Create</a>
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
			@foreach ($users as $user)
				<tr>
					<td>{{ $user->getDisplayName() }}</td>
					<td>
						<a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary">Edit</a>
						<form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}" style="display:inline;">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete {{ $user->getDisplayName() }}?');">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>

		{{ $users->links() }}
	</div>
@endsection
