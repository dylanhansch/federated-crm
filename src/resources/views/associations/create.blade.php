@extends('layouts.app')

@section('title', 'Create Association')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Create Association</h1>
	</div>

	<form method="POST" action="{{ route('associations.store') }}" role="form">
		@csrf

		<div class="row">
			<div class="col-lg-12">
				@include('layouts.errors')

				<div class="form-group row">
					<div class="col-md-3">
						<label for="name">Name:</label>
						<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="Auto Group" value="{{ old('name') }}" required>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<button class="btn btn-primary" type="submit" name="create"><span data-feather="plus"></span> Create</button>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
