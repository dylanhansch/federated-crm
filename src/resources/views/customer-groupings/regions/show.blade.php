@extends('layouts.app')

@section('title', 'Region: ' . $region->name)

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Region: {{ $region->name }}</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="{{ route('regions.edit', ['region' => $region->id]) }}" class="btn btn-primary"><span data-feather="edit"></span> Edit</a>
		</div>
	</div>
@endsection
