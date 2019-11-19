@extends('layouts.app')

@section('title', 'District: ' . $district->name)

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">District: {{ $district->name }}</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="{{ route('districts.edit', ['district' => $district->id]) }}" class="btn btn-primary"><span data-feather="edit"></span> Edit</a>
		</div>
	</div>
@endsection
