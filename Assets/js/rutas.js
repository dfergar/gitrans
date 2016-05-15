window.onload=function(){
	document.getElementById("addcarga").onclick = function() {agrega("cargas")};
	document.getElementById("adddescarga").onclick = function() {agrega("descargas")};
	//document.getElementById("delcarga").onclick = function() {elimina("cargas")};
	//document.getElementById("deldescarga").onclick = function() {elimina("descargas")};

};

/*function cuentacargas()
{
	try {
		cuenta=document.getElementById("cargas").getElementsByTagName("input").length;
	return cuenta;}
	catch (e){
	return 0;}
}

function cuentadescargas()
{
	try {
		cuenta=document.getElementById("descargas").getElementsByTagName("input").length;
	return cuenta;}
	catch (e){
	return 0;}
}*/

function initMap() {
  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer;
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 6,
    center: {lat: 40.429507, lng: -3.708384}
  });
  directionsDisplay.setMap(map);

  document.getElementById('submit').addEventListener('click', function() {
    calculateAndDisplayRoute(directionsService, directionsDisplay);
  });
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
  var waypts = [];
  var escalas = document.getElementsByName('waypoints');
  for (var i = 0; i < escalas.length; i++) {
    if (escalas[i]) {
      waypts.push({
        location: escalas[i].value,
        stopover: true
      });
    }
  }

	var request = {
		origin: document.getElementById('start').value,
    destination: document.getElementById('end').value,
    waypoints: waypts,
    optimizeWaypoints: false,
    travelMode: google.maps.TravelMode.DRIVING		
	}

  directionsService.route(request, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var summaryPanel = document.getElementById('directions-panel');
      summaryPanel.innerHTML = '';
      // For each route, display summary information.
      var total=0;
      for (var i = 0; i < route.legs.length; i++) {
        var routeSegment = i + 1;
        summaryPanel.innerHTML += '<b>Escala: ' + routeSegment +
            '</b><br>';
        summaryPanel.innerHTML += route.legs[i].start_address + ' a ';
        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
        total += route.legs[i].distance.value;

      }
    } else {
      window.alert('La búsqueda de ruta falló por ' + status);
    }
    summaryPanel.innerHTML += 'DISTANCIA TOTAL: ' + Math.round(total/1000) + ' Km<br><br>';

  });
}



function borrar(elemento)
{
	
	padre = elemento.parentNode;
	abuelo= padre.parentNode;
	abuelo.removeChild(padre);	
	
}
function agrega(tipo)
{
  var lista = document.getElementById(tipo);
  var carga= document.createElement("div");
  var campo = document.createElement("input");
  //var numero=lista.getElementsByTagName("input").length;

	campo.setAttribute("type", "text");
	campo.setAttribute("name", "waypoints");
        campo.setAttribute("class", tipo);
	//campo.setAttribute("id", numero);
	campo.setAttribute("placeholder", "calle, cp, ciudad, país...");
    carga.appendChild(campo);
	lista.appendChild(carga);
	
	var boton = document.createElement("button");
	boton.setAttribute("class","btn btn-primary");
	var icono = document.createElement("span");
        icono.setAttribute("class", "glyphicon glyphicon-remove");
        boton.appendChild(icono);
	
	
	carga.appendChild(boton);
	boton.setAttribute("onclick", "borrar(this)");

	/*var salto = document.createElement("br");
	lista.appendChild(salto);
	if(tipo=="cargas") document.getElementById("delcarga").disabled=false;
	if(tipo=="descargas") document.getElementById("deldescarga").disabled=false;*/

}

/*function elimina(tipo)
{
  var lista = document.getElementById(tipo);
  var elemento = lista.getElementsByTagName("input");

	var saltos = lista.getElementsByTagName("br");
	lista.removeChild(elemento[0]);
	lista.removeChild(saltos[0]);

	  if(elemento.length<1) {
		  if(tipo=="cargas") document.getElementById("delcarga").disabled=true;
		  if(tipo=="descargas") document.getElementById("deldescarga").disabled=true;
	  }

}*/
