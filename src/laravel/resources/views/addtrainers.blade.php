@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Používatelia na schválenie za Trénera</div>

				<div class="panel-body" >
					{!!  Form::open(['class' => 'form--label-bold']) !!}
					@forelse($names->all() as $name)
							@if (($name->is_admin == '0'or $name->is_admin == false) and ($name->is_trainer=='0' or $name->is_trainer == false ))

							<div class="col-xs-12 col-sm-4 form__div--user">
								<label class="form__label--cursor">
									<span class='form__label--normal'>Meno: </span> {{ $name->name }} <br />
									<span class='form__label--normal'>E-Mail: </span> {{ $name->email }} <br />
									<span class='form__label--normal form__label--italic'>nastaviť ako trénera:</span>
									{!!  Form::radio('agree', $name->email) !!}
								</label>
							</div>

							@endif
					@empty
						<p>V databáze nie sú evidovaní žiadni používatelia!</p>
					@endforelse
					{!!  Form::submit('Nastaviť', array('class' => 'pull-left btn btn-sm btn-primary col-xs-12')) !!}
					{!!  Form::close() !!}
				</div>
			</div>

		</div>
	</div>
</div>

@endsection



