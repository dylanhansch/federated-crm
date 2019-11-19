@extends('layouts.app')

@section('title', 'Create Territory')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Create Territory</h1>
	</div>

	<form method="POST" action="{{ route('territories.store') }}" role="form">
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
						<label for="district">District:</label>
						<select class="form-control" name="district_id" id="district">
							@foreach ($districts as $district)
								<option value="{{ $district->id }}">{{ $district->name }}</option>
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
