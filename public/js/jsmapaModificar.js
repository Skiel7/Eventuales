var geocoder;
var map;
var lat = null;
var lng = null;
var marker = null;
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng($('#lat').val(), $('#long').val());
  var mapOptions = {
    zoom: 15,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	//creamos el marcador en el mapa
	marker = new google.maps.Marker({
		map: map,//el mapa creado en el paso anterior
		position: latlng,//objeto con latitud y longitud
		draggable: true //que el marcador se pueda arrastrar
	});

	//función que actualiza los input del formulario con las nuevas latitudes
	//Estos campos suelen ser hidden
	updatePosition(latlng);
	//Añado un listener para cuando el markador se termine de arrastrar
	//actualize el formulario con las nuevas coordenadas
	google.maps.event.addListener(marker, 'dragend', function(){
		updatePosition(marker.getPosition());
	});
}

function codeAddress() {
  var address = document.getElementById('direccion').value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
		//centra el mapa en las nuevas coordenadas
		map.setCenter(results[0].geometry.location);
		//reubico el marcador
	    marker.setPosition(results[0].geometry.location);
		updatePosition(results[0].geometry.location);
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

//actualiza los campos del formulario
function updatePosition(latlng)
{  
   jQuery('#lat').val(latlng.lat());
   jQuery('#long').val(latlng.lng());
}

google.maps.event.addDomListener(window, 'load', initialize);