<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="description" content="">
		<meta name="theme-color" content="#9B2F22">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>@yield('title') - {{ config('app.name') }}</title>

		<meta property="og:title" content="@yield('title') - {{ config('app.name') }}">
		<meta property="og:description" content="">
		<meta property="og:type" content="website">
		<meta property="og:url" content="{{ request()->fullUrl() }}">
		<meta property="og:locale" content="en_US">

		<!-- Scripts -->
		<script src="{{ asset('assets/js/app.js') }}" defer></script>

		<!-- Styles -->
		<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

		<!-- Favicons -->
		<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicons/favicon-32x32.png') }}">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicons/favicon-16x16.png') }}">
	</head>
	<body>
		<div id="app">
			@yield('app')
		</div>
	</body>
</html>
