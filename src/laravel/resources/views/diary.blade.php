@extends('app')

@section('content')

    


    <div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		@if(Auth::user()->is_trainer)
               <h2>Zrejme ste zablúdili!</h2>
             @else
			<h1 class="h1--diary">Zápisník výsledkov behania</h1>
			<div class="panel panel-default">
				<div class="panel-heading">Formulár pre zápis výsledkov behania do bežeckých plánov</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Hups!</strong> Vyskytol sa problém s pridaním záznamu.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<?php $all = 0; ?>
						{!!  Form::open(['class' => 'form--label-bold']) !!}

						{!! Form::label('distance', 'Zabehnutá vzdialenosť (m): ', ["class" => "col-xs-12 col-sm-3"]) !!}
						{!! Form::number('distance', null, [
							'placeholder' => 'odbehnutá vzdialenosť v metroch',
							"class" => "col-xs-12 col-sm-9",
							"required" => "true",
							"min" => 1
						]) !!}

						<div class="div--vertical-space col-xs-12"></div>

						{!! Form::label('date', 'Dátum behania: ', ["class" => "col-xs-12 col-sm-3"]) !!}
						{!! Form::text('date', null, [
                            'placeholder' => 'dátum behania:',
                            "class" => "col-xs-12 col-sm-9",
                            "required" => "true"
                        ]) !!}

						{!! Form::label('mood', 'Ako sa ti behalo? ', ["class" => "col-xs-12 col-sm-3"]) !!}
						<div class="col-xs-12 col-sm-9 div--no-padding">
							{!! Form::select('mood', [1 => 'Výborne', 2 => 'Dobre', 3 => 'Nič moc', 4 => 'Zle']) !!}
						</div>

						<div class="div--vertical-space col-xs-12"></div>

						{!!  Form::submit('Pridaj záznam', ['class' => 'pull-left btn btn-sm btn-primary col-xs-12']) !!}

						{!!  Form::close() !!}
					
				</div>
			</div>
		@endif
		</div>
	</div>
</div>



	<script>
		$(document).ready(function() {
			( function( factory ) {
				if ( typeof define === "function" && define.amd ) {

					// AMD. Register as an anonymous module.
					define( [ "../widgets/datepicker" ], factory );
				} else {

					// Browser globals
					factory( jQuery.datepicker );
				}
			}( function( datepicker ) {

				datepicker.regional.sk = {
					closeText: "Zavrieť",
					prevText: "&#x3C;Predchádzajúci",
					nextText: "Nasledujúci&#x3E;",
					currentText: "Dnes",
					monthNames: [ "január","február","marec","apríl","máj","jún",
						"júl","august","september","október","november","december" ],
					monthNamesShort: [ "Jan","Feb","Mar","Apr","Máj","Jún",
						"Júl","Aug","Sep","Okt","Nov","Dec" ],
					dayNames: [ "nedeľa","pondelok","utorok","streda","štvrtok","piatok","sobota" ],
					dayNamesShort: [ "Ned","Pon","Uto","Str","Štv","Pia","Sob" ],
					dayNamesMin: [ "Ne","Po","Ut","St","Št","Pia","So" ],
					weekHeader: "Ty",
					dateFormat: "dd.mm.yy",
					firstDay: 1,
					isRTL: false,
					showMonthAfterYear: false,
					yearSuffix: "" };
				datepicker.setDefaults( datepicker.regional.sk );

				return datepicker.regional.sk;

			} ) );

			$("#date").datepicker();
		});
	</script>

@endsection
