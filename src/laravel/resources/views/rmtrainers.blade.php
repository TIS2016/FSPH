@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Odstránenie Trénera</div>

				<div class="panel-body">
					{!!  Form::open(['class' => 'form--label-bold']) !!}
					@forelse($names->all() as $name)
							@if (($name->is_admin == '0'or $name->is_admin == false) and ($name->is_trainer!='0' or $name->is_trainer == true ))

							<div class="col-xs-12 col-sm-4 form__div--user">
								<label class="form__label--cursor">
									<span class='form__label--normal'>Meno: </span> {{ $name->name }} <br />
									<span class='form__label--normal'>E-Mail: </span> {{ $name->email }} <br />
									<span class='form__label--normal form__label--italic'>odobrať status trénera:</span>
									{!!  Form::radio('disagree',$name->email) !!}
								</label>
							</div>

							@endif
					@empty
						<p>V databáze nie sú evidovaní žiadni tréneri!</p>
					@endforelse
					{!!  Form::submit('Zrušiť', array('class' => 'pull-left btn btn-sm btn-primary col-xs-12', 'style' => 'background-color:red; border-color:red;')) !!}
					{!!  Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection



