<nav class="col-md-2 d-none d-md-block bg-light sidebar">
	<div class="sidebar-sticky">
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link @if(request()->routeIs('dashboard*')) active @endif" href="{{ route('dashboard') }}">
					<span data-feather="home"></span>
					Dashboard <span class="sr-only">(current)</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link @if(request()->routeIs('customers*') || request()->routeIs('contacts*')) active @endif" href="{{ route('customers.index') }}">
					<span data-feather="users"></span>
					Customers
				</a>
			</li>
			<!--<li class="nav-item">
				<a class="nav-link @if(request()->routeIs('reports*')) active @endif" href="#">
					<span data-feather="bar-chart-2"></span>
					Reports
				</a>
			</li>-->
			@can('view-regions')
			<li class="nav-item">
				<a class="nav-link @if(request()->routeIs('regions*')) active @endif" href="{{ route('regions.index') }}">
					<span data-feather="globe"></span>
					Regions
				</a>
			</li>
			@endcan
			@can('view-districts')
				<li class="nav-item">
					<a class="nav-link @if(request()->routeIs('districts*')) active @endif" href="{{ route('districts.index') }}">
						<span data-feather="globe"></span>
						Districts
					</a>
				</li>
			@endcan
			@can('view-territories')
				<li class="nav-item">
					<a class="nav-link @if(request()->routeIs('territories*')) active @endif" href="{{ route('territories.index') }}">
						<span data-feather="globe"></span>
						Territories
					</a>
				</li>
			@endcan
			@can('view-users')
				<li class="nav-item">
					<a class="nav-link @if(request()->routeIs('users*')) active @endif" href="{{ route('users.index') }}">
						<span data-feather="users"></span>
						Users
					</a>
				</li>
			@endcan
			@can('view-associations')
				<li class="nav-item">
					<a class="nav-link @if(request()->routeIs('associations*')) active @endif" href="{{ route('associations.index') }}">
						<span data-feather="users"></span>
						Associations
					</a>
				</li>
			@endcan
			@can('view-reports')
				<li class="nav-item">
					<a class="nav-link @if(request()->routeIs('reports*')) active @endif" href="{{ route('reports.index') }}">
						<span data-feather="book"></span>
						Reports
					</a>
				</li>
			@endcan
		</ul>

		<!--<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
			<span>Saved reports</span>
			<a class="d-flex align-items-center text-muted" href="#">
				<span data-feather="plus-circle"></span>
			</a>
		</h6>
		<ul class="nav flex-column mb-2">
			<li class="nav-item">
				<a class="nav-link" href="#">
					<span data-feather="file-text"></span>
					Current month
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					<span data-feather="file-text"></span>
					Last quarter
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					<span data-feather="file-text"></span>
					Social engagement
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					<span data-feather="file-text"></span>
					Year-end sale
				</a>
			</li>
		</ul>-->
	</div>
</nav>
