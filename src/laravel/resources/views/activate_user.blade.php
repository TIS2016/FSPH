@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Používatelia na schválenie</div>

				<div class="panel-body" >
					<?php $inactive = 0; ?>
					{!!  Form::open(['class' => 'form--label-bold']) !!}
					@forelse($names->all() as $name)
							@if ($name->is_active == 0 )
								<?php $inactive += 1; ?>

								<div class="col-xs-12 col-sm-4 form__div--user">
									<label class="form__label--cursor">
										<span class='form__label--normal'>Meno: </span> {{ $name->name }} <br />
										<span class='form__label--normal'>E-Mail: </span> {{ $name->email }} <br />
										<span class='form__label--normal form__label--italic'>nastaviť ako aktívne konto:</span>
										{!!  Form::radio('agree', $name->id) !!}
									</label>
								</div>
							@endif
					@empty
						<p>V databáze nie sú evidovaní žiadni používatelia!</p>
					@endforelse
					{!!  Form::submit('Aktivovať', array('class' => 'pull-left btn btn-sm btn-primary col-xs-12')) !!}
					{!!  Form::close() !!}


				</div>
			</div>
			@if($inactive == 0)
				<p><strong>Všetci čakatelia sú schválení!</strong></p>
			@endif
		</div>
	</div>

</div>

@endsection



