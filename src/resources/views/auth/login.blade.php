@extends('layouts.core')

@section('title', 'Login')

@section('app')
	<div class="flag-bg">
		<div class="container">
			<div class="row justify-content-center" style="padding-top: 50px">
				<div class="col-md-4">
					<img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="Federated Insurance Logo">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 rounded-padded-box">
					<h1>Login</h1>

					<form method="POST" action="{{ route('login') }}">
						@csrf

						<div class="form-group row">
							<div class="col-md-12">
								<label for="email" class="col-form-label">Email: </label>
								<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

								@if ($errors->has('email'))
									<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-12">
								<label for="password" class="col-form-label">Password: </label>
								<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

								@if ($errors->has('password'))
									<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-12">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

									<label class="form-check-label" for="remember">Remember Me</label>
								</div>
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary">Login</button>

								<a class="btn btn-link" href="{{ route('password.request') }}">Forgot Password</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
