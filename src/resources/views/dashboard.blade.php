@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Dashboard</h1>
	</div>

	<!-- TODO: Idk what to add here but we need more.. -->

	<div class="row">
		<div class="col-md-4">
			<h2>Today's To-Do</h2>
			<ul class="list-group">
				<li class="list-group-item">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="todoCheck1">
						<label class="form-check-label" for="todoCheck1">
							Totally
						</label>
					</div>
				</li>
				<li class="list-group-item">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="todoCheck2">
						<label class="form-check-label" for="todoCheck2">
							Non-functioning
						</label>
					</div>
				</li>
				<li class="list-group-item">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="todoCheck3">
						<label class="form-check-label" for="todoCheck3">
							To-do list
						</label>
					</div>
				</li>
				<li class="list-group-item">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="todoCheck4">
						<label class="form-check-label" for="todoCheck4">
							Make To-Do & Upcoming Events actually work
						</label>
					</div>
				</li>
			</ul>
		</div>

		<div class="col-md-4">
			<h2>Upcoming Events</h2>

			<ul class="list-group">
				<li class="list-group-item list-group-item-danger">Super Urgent Meeting (12/4/2019 8:00 AM)</li>
				<li class="list-group-item list-group-item-warning">Bob's Birthday (12/5/2019)</li>
				<li class="list-group-item">Jimmy's Birthday (12/6/2019)</li>
				<li class="list-group-item">Jimmy's Annual Review (12/16/2019 2:00 PM)</li>
			</ul>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<h2>Overall Cultivation Loop Status</h2>

			<div class="progress">
				@foreach ($cultivationStatuses as $cultivationStatus)
					<div class="progress-bar progress-bar-striped progress-bar-animated bg-{{ $cultivationStatus['color'] }}" role="progressbar" style="width: {{ $cultivationStatus['percentage'] }}%" aria-valuenow="{{ $cultivationStatus['percentage'] }}" aria-valuemin="0" aria-valuemax="{{ $cultivationStatus['percentage'] }}">{{ $cultivationStatus['label'] }}</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
