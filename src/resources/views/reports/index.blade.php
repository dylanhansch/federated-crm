@extends('layouts.app')

@section('title', 'Reports')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Reports</h1>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="list-group">
				@can('view-cultivation-loop-statuses-report')
					<a href="{{ route('reports.cultivation-loop-statuses') }}" class="list-group-item list-group-item-action">Cultivation Loop Statuses</a>
				@endcan
			</div>
		</div>
	</div>
@endsection
