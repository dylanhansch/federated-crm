@extends('layouts.core')

@section('title', 'Reset Password')

@section('app')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<h1>Reset Password</h1>

				<form method="POST" action="{{ route('password.update') }}">
					@csrf

					<input type="hidden" name="token" value="{{ $token }}">

					<div class="form-group row">
						<div class="col-md-12">
							<label for="email" class="col-form-label">Email: </label>
							<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

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
							<label for="password-confirm" class="col-form-label">Confirm Password</label>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-12">
							<button type="submit" class="btn btn-primary">Reset Password</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
