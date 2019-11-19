@extends('layouts.app')

@section('title', 'Create District')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Create District</h1>
	</div>

	<form method="POST" action="{{ route('districts.store') }}" role="form">
		@csrf

		<div class="row">
			<div class="col-lg-12">
				@include('layouts.errors')

				<div class="form-group row">
					<div class="col-md-3">
						<label for="name">Name:</label>
						<input type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="Northwest" value="{{ old('name') }}">
					</div>

					<div class="col-md-3">
						<label for="region">Region:</label>
						<select class="form-control" name="region_id" id="region">
							@foreach ($regions as $region)
								<option value="{{ $region->id }}">{{ $region->name }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<button class="btn btn-primary" type="submit" name="create">Create</button>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
