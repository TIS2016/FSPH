@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Výber skupiny na editovanie: </div>

				<div class="panel-body" >

					{!!  Form::open(['class' => 'form--label-bold']) !!}

						{!! Form::label('group', 'Vyber skupinu: ', ["class" => "col-xs-12 col-sm-3"]) !!}
						<div class="col-xs-12 col-sm-9 div--no-padding">
							{!! Form::select('group', $items) !!}
						</div>

					<div class="div--vertical-space col-xs-12"></div>

					{!!  Form::submit('Upraviť', array('class' => 'pull-left btn btn-sm btn-primary col-xs-12','name'=>'action','value'=>'load')) !!}

					{!!  Form::close() !!}


				</div>
			</div>

		</div>
	</div>
</div>

@endsection



