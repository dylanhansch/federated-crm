@extends('layouts.app')

@section('title', "Edit Association: {$association->name}")

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Edit Association: {{ $association->name }}</h1>
	</div>

	<form method="POST" action="{{ route('associations.update', ['association' => $association->id]) }}" role="form">
		@csrf
		@method('PATCH')

		<div class="row">
			<div class="col-lg-12">
				@include('layouts.success')
				@include('layouts.errors')

				<div class="form-group row">
					<div class="col-md-3">
						<label for="name">Name:</label>
						<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ $association->name }}" required>
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
@endsection
