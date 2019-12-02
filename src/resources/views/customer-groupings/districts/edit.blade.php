@extends('layouts.app')

@section('title', 'Edit District: ' . $district->name)

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Edit District: {{ $district->name }}</h1>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<form method="POST" action="{{ route('districts.update', ['district' => $district->id]) }}" role="form">
				@csrf
				@method('PATCH')

				<div class="row">
					<div class="col-lg-12">
						@include('layouts.errors')

						<div class="form-group row">
							<div class="col-md-3">
								<label for="name">Name:</label>
								<input type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="Northwest" value="{{ $district->name }}">
							</div>

							<div class="col-md-3">
								<label for="region">Region:</label>
								<select class="form-control" name="region_id" id="region">
									@foreach ($regions as $region)
										<option value="{{ $region->id }}" @if($district->region->id === $region->id) selected @endif>{{ $region->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-3">
								<button class="btn btn-primary" type="submit" name="save"><span data-feather="save"></span> Save</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="col-lg-12">
			<h3>Assigned Users</h3>

			@forelse ($district->getAssignedUsers() as $user)
				<div class="row" style="padding-bottom: 10px;">
					<div class="col-lg-12">
						<span style="margin-right: 7px">{{ $user->getDisplayName() }}</span>
						<form method="POST" action="{{ route('districts.removeAssignedUser', ['district' => $district->id, 'user' => $user->id]) }}" style="display:inline;">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to unassign {{ $user->getDisplayName() }} from {{ $district->name }}?');">
								<span data-feather="trash-2"></span>
							</button>
						</form>
					</div>
				</div>
			@empty
				<p>No users assigned.</p>
			@endforelse

			<h4 style="padding-top:25px">Add User</h4>

			<form method="POST" action="{{ route('districts.addAssignedUser', ['district' => $district->id]) }}" style="display:inline;">
				@csrf

				<div class="row">
					<div class="col-lg-12">
						@include('layouts.errors')

						<div class="form-group row">
							<div class="col-md-3">
								<label for="name">Add User:</label>
								<select class="form-control" name="user" id="user">
									@foreach ($usersAvailableForAddAccess as $user)
										<option value="{{ $user->id }}">{{ $user->getDisplayName() }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-3">
								<button class="btn btn-success" type="submit" name="add"><span data-feather="plus"></span> Add</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
