@extends('layouts.app')

@section('title', 'Associations')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Associations</h1>
		@can('create-associations')
			<div class="btn-toolbar mb-2 mb-md-0">
				<a href="{{ route('associations.create') }}" class="btn btn-primary" role="button"><span data-feather="plus"></span> Create</a>
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
				@forelse ($associations as $association)
					<tr>
						<td><a href="{{ route('associations.show', ['association' => $association->id]) }}">{{ $association->name }}</a></td>
						<td>
							@can('edit-associations')
								<a href="{{ route('associations.edit', ['association' => $association->id]) }}" class="btn btn-primary" role="button"><span data-feather="edit"></span> Edit</a>
							@endcan
							@can('destroy-associations')
								<form method="POST" action="{{ route('associations.destroy', ['association' => $association->id]) }}" style="display:inline;">
									@csrf
									@method('DELETE')
									<button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete {{ $association->name }}?');"><span data-feather="trash-2"></span> Delete</button>
								</form>
							@endcan
						</td>
					</tr>
				@empty
					<td>No associations available. @can('create-associations') <a href="{{ route('associations.create') }}">Create one</a>! @endcan</td>
					<td></td>
				@endforelse
			</tbody>
		</table>

		{{ $associations->links() }}
	</div>
@endsection
