<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
	<a class="navbar-brand col-sm-3 col-md-2 mr-0 text-center" href="{{ route('dashboard') }}">
		<img src="{{ asset('assets/img/logo-small.png') }}" class="img-fluid brand-img" alt="{{ config('app.name') }} Logo">
	</a>
	<ul class="navbar-nav px-3">
		<li class="nav-item text-nowrap">
			<a class="nav-link" href="{{ route('logout') }}">Sign out</a>
		</li>
	</ul>
</nav>
