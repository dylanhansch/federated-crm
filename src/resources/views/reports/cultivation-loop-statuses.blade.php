@extends('layouts.app')

@section('title', 'Cultivation Loop Statuses Report')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Cultivation Loop Statuses Report</h1>
		<p>Generated: {{ now() }}</p>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">User</th>
						<th scope="col">% Complete</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td>{{ $user->getDisplayName() }}</td>
							<td>
								@if (sizeof($user->getCultivationLoopStatus()) == 3 && array_key_exists('percentage', $user->getCultivationLoopStatus()[2]))
									{{ round($user->getCultivationLoopStatus()[2]['percentage'], 2) }}%
								@else
									0%
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
