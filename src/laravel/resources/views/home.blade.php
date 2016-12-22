@extends('app')

@section('content')


	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">

					<div class="panel-body">
						<p class="citat"> Ľudia nebehajú preto, aby boli šťastní, ale sú šťastní preto, že behajú.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><strong class="citat">Domov</strong></div>

				<div class="panel-body">
					Ste úspešne prihlásený!<br><br>
					<strong>This is only prototype, so be tolerant.</strong><br><br>

				</div>

			</div>
		</div>
	</div>
</div>

	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">

					<div class="panel-body">
						<p> V tejto pozicii sa mozu nachadzat rozne oznami, napriklad cas treningu, mapa s polohou... Vsetko je uz len na adminovi. Ako priklad uvadzame pouzitie mapy...</p><br>
						<div id="map" style="width:100%;height:300px"></div>

						<script>
							function myMap() {
								var myLatLng = {lat: 48.152560, lng: 17.071135};

								var mapCanvas = document.getElementById("map");
								var mapOptions = {
									center: new google.maps.LatLng(48.152560, 17.071135),
									zoom: 16
								}
								var map = new google.maps.Map(mapCanvas, mapOptions);

								var marker = new google.maps.Marker({
									position: myLatLng,
									animation:google.maps.Animation.BOUNCE,
									map: map,
									title: 'Example'
								});
							}
						</script>
						<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLim4RnKtK7UkF54vCnIFRJNTGhDc4WSI&callback=myMap"
								async defer></script>
					</div>
				</div>
			</div>
		</div>

@endsection
