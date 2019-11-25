@extends('layouts.core')

@section('title', 'Reset Password')

@section('app')
	<div class="flag-bg">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 rounded-padded-box">
					<h1>Reset Password</h1>

					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					<form method="POST" action="{{ route('password.email') }}">
						@csrf

						<div class="form-group row">
							<div class="col-md-12">
								<label for="email" class="col-form-label">Email: </label>
								<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

								@if ($errors->has('email'))
									<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary">Send Password Reset Link</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
