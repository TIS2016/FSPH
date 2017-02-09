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

				<div class="panel-body">
					<div class="runner__description--text col-xs-12">
						<table class="table--running-data hidden-xs">
							<tr>
								<th>Dátum záznamu</th>
								<th>Odbehnutá vzdialenosť (m)</th>
								<th>:&nbsp;)</th>
							</tr>

							@foreach($running_datas as $running_data)
								<tr>
									<td>{{ date("d. m. Y", strtotime($running_data->date)) }}</td>
									<td>{{ $running_data->distance }}</td>
									<td class="td--running-data-mood-{{ $running_data->mood }}">
										@if($running_data->mood == 1)
											:&nbsp;)
										@elseif($running_data->mood == 2)
											:&nbsp;]
										@elseif($running_data->mood == 3)
											:&nbsp;|
										@elseif($running_data->mood == 4)
											:&nbsp;(
										@endif
									</td>
								</tr>
							@endforeach

							<tr class="table__row--sum">
								<th>Celkovo:</th>
								<th>{{ $total_distance / 1000 }} km</th>
								<th class="td--running-data-mood-{{ $avg_mood }}">
									@if($avg_mood == 1)
										:&nbsp;)
									@elseif($avg_mood == 2)
										:&nbsp;]
									@elseif($avg_mood == 3)
										:&nbsp;|
									@elseif($avg_mood == 4)
										:&nbsp;(
									@endif
								</th>
							</tr>
						</table>

						<table class="table--running-data visible-xs">
							<tr>
								<th colspan="2">Záznamy</th>
							</tr>

							@foreach($running_datas as $running_data)
								<tr class="td--running-data-mood-{{ $running_data->mood }}">
									<td>{{ date("d. m. Y", strtotime($running_data->date)) }}</td>
									<td>{{ $running_data->distance }} m</td>
								</tr>
							@endforeach

							<tr class="table__row--sum td--running-data-mood-{{ $avg_mood }}">
								<th>Celkovo:</th>
								<th>{{ $total_distance / 1000 }} km</th>
							</tr>
						</table>
					</div>
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
