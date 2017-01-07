@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Obnovenie Hesla</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal form--label-bold" role="form" method="POST" action="{{ url('/password/reset') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group">
							<label for="f_email" class="col-md-4 control-label">E-Mail Adresa:</label>
							<div class="col-md-6">
								<input placeholder="e-mail adresa" id="f_email" type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label for="f_password" class="col-md-4 control-label">Heslo:</label>
							<div class="col-md-6">
								<input placeholder="heslo" id="f_password" type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label for="f_password_confirmation" class="col-md-4 control-label">Potvrdiť Heslo:</label>
							<div class="col-md-6">
								<input placeholder="potvrdenie hesla" id="f_password_confirmation" type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Obnoviť Heslo
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
