@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Vytvorenie skupiny</div>
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
						<?php $all = 0; ?>
						{!!  Form::open(['class' => 'form--label-bold']) !!}

						{!! Form::label('groupName', 'Skupina: ', ["class" => "col-xs-12 col-sm-3"]) !!}
						{!! Form::text('groupName', null, [
                                    'placeholder' => 'meno skupiny',
                                    "class" => "col-xs-12 col-sm-9",
                                    "required" => "true"
						]) !!}

						<p class="col-xs-12" style="text-decoration: underline; margin-top: 25px; margin-bottom: 25px;"><strong>Bežci bez skupiny:</strong> </p>
						@forelse($names->all() as $name)
							@if ($name->group_id == 0 and $name->is_trainer == 0 and $name->is_admin != true and $name->is_active == 1)
								<?php $all += 1; ?>

								<div class="col-xs-12 col-sm-4 form__div--user">
									<label class="form__label--cursor">
										<span class='form__label--normal'>Meno: </span> {{ $name->name }} <br />
										<span class='form__label--normal'>E-Mail: </span> {{ $name->email }} <br />
										<span class='form__label--normal form__label--italic'>pridať do novej Skupiny:</span>
										{!! Form::checkbox('agree[]', $name->id) !!}
									</label>
								</div>
							@endif
						@empty
							<p>V databáze nie sú evidovaní žiadni používatelia!</p>
						@endforelse

						{!!  Form::submit('Vytvoriť', array('class' => 'pull-left btn btn-sm btn-primary col-xs-12')) !!}

						{!!  Form::close() !!}
				</div>
			</div>
			@if($all == 0)
				<p><strong>Žiadny používatelia na výber do skupiny!</strong></p>
			@endif
		</div>
	</div>
</div>
@endsection
