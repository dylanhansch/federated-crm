@extends('layouts.core')

@section('app')
	@include('layouts.navbar')

	<div class="container-fluid">
		<div class="row">
			@include('layouts.sidebar')

			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
				@yield('content')

				@include('layouts.footer')
			</main>
		</div>
	</div>
@endsection
