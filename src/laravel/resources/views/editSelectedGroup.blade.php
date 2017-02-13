@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Editovanie skupiny: </div>

				<div class="panel-body" >

					{!!  Form::open(['class' => 'form--label-bold']) !!}

					{!! Form::text('id', $grp->id, array('style' => 'display:none;')) !!}

					{!! Form::label('grp_name', 'Meno skupiny: ', ["class" => "col-xs-12 col-sm-3"]) !!}
					{!! Form::text('grp_name', $grp->name, [
						'placeholder' => 'meno skupiny',
						"class" => "col-xs-12 col-sm-9",
						"required" => "true"
					]) !!}

					<div class="div--vertical-space col-xs-12"></div>

					{!! Form::label('delete', 'Vymaž bežcov zo skupiny: ', ["class" => "col-xs-12"]) !!}

					<div class="div--vertical-space col-xs-12"></div>

						@foreach($names as $name)
							@if($name->group_id == $grp->id)

							<div class="col-xs-12 col-sm-4 form__div--user">
								<label class="form__label--cursor">
									<span class='form__label--normal'>Meno: </span> {{ $name->name }} <br />
									<span class='form__label--normal'>E-Mail: </span> {{ $name->email }} <br />
									<span class='form__label--normal form__label--italic label-group--delete'>odobrať bežca:</span>
									{!! Form::checkbox('agreeDel[]', $name->id) !!}
								</label>
							</div>

							@endif
						@endforeach

					<div class="div--vertical-space col-xs-12"></div>

					{!! Form::label('add', 'Pridaj bežcov bez skupiny: ', ["class" => "col-xs-12"]) !!}

					<div class="div--vertical-space col-xs-12"></div>

					@forelse($names as $name)
						@if($name->group_id == 0 and $name->is_trainer == 0 and $name->is_admin != true and $name->is_active == 1)

							<div class="col-xs-12 col-sm-4 form__div--user">
								<label class="form__label--cursor">
									<span class='form__label--normal'>Meno: </span> {{ $name->name }} <br />
									<span class='form__label--normal'>E-Mail: </span> {{ $name->email }} <br />
									<span class='form__label--normal form__label--italic label-group--add'>pridať bežca:</span>
									{!! Form::checkbox('agreeAdd[]', $name->id) !!}
								</label>
							</div>

						@endif
					@empty
						<p>V databáze nie sú evidovaní žiadni používatelia!</p>
					@endforelse



					
					{!!  Form::submit('Uložiť', array('class' => 'pull-left btn btn-sm btn-primary col-xs-12','name'=>'action','value'=>'editing')) !!}
					{!!  Form::close() !!}


				</div>
			</div>

		</div>
	</div>
</div>

@endsection



