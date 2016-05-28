window.onload=function(){
       
        document.getElementById("addcarga").onclick = function() {agrega("cargas")};
	document.getElementById("adddescarga").onclick = function() {agrega("descargas")};
        document.getElementById("validar").onclick = function() {mostrar_form();nombrar();};
      
                
	//document.getElementById("delcarga").onclick = function() {elimina("cargas")};
	//document.getElementById("deldescarga").onclick = function() {elimina("descargas")};

}

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
  var escalas = document.getElementsByClassName('waypoints');
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
    document.getElementById('validar').disabled=false;
    
    document.getElementById('km').value=Math.round(total/1000);
  });  
  
}



function borrar(elemento)
{
	
	padre = elemento.parentNode;
	abuelo= padre.parentNode;
	abuelo.removeChild(padre);
               
       
        //cargas = document.getElementById(tipo); // 1
        //cargas.removeChild(document.getElementById(div)); // 10
        //document.getElementById('num_etapas').value--;

	
}

function agrega(tipo)
{
    
    var lista = document.getElementById(tipo);
    var carga= document.createElement("div");
    carga.setAttribute("id","div"+document.getElementById('n'+tipo).value);
    lista.appendChild(carga);

    var campo = document.createElement("input");
  

    campo.setAttribute("type", "text");        
    // se nombrará con nombrar() al hacer submit     
    campo.setAttribute("class", "waypoints"); 
    campo.setAttribute("placeholder", "calle, cp, ciudad, país...");        
    carga.appendChild(campo);


    var boton = document.createElement("button");
    boton.setAttribute("class","btn btn-primary");
    var icono = document.createElement("span");
    icono.setAttribute("class", "glyphicon glyphicon-remove");
    boton.appendChild(icono);
    boton.setAttribute("onclick", "borrar(this)");	
    carga.appendChild(boton);
    
        
    
    
}

function nombrar()
{
    var ncargas = [];    
    var cargas = document.getElementById("cargas");
    ncargas=cargas.getElementsByTagName("input");
    for(i=0;i<ncargas.length;i++)
    {
        ncargas[i].setAttribute("name", "carga"+i);
    }
    document.getElementById('ncargas').value=ncargas.length;
    
    var ndescargas = [];
    var descargas = document.getElementById("descargas");
    ndescargas=descargas.getElementsByTagName("input");
    for(i=0;i<ndescargas.length;i++)
    {
        ndescargas[i].setAttribute("name", "descarga"+i);
    }
    document.getElementById('ndescargas').value=ndescargas.length;
    
        
}

function mostrar_form()
{
    document.getElementById('datos').style.display = 'block';
    document.getElementById('validar').style.display = 'none';
        
}




