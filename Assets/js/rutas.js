window.onload=function(){
       
        document.getElementById("addcarga").onclick = function() {agrega("cargas")};
	document.getElementById("adddescarga").onclick = function() {agrega("descargas")};
        document.getElementById("validar").onclick = function() {mostrar_form();nombrar();};
      
                
	//document.getElementById("delcarga").onclick = function() {elimina("cargas")};
	//document.getElementById("deldescarga").onclick = function() {elimina("descargas")};

}
var map;
/**
 * Inicialización del map
 */

function initMap() {
  var directionsService = new google.maps.DirectionsService;
  //var directionsDisplay = new google.maps.DirectionsRenderer;
  
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 6,
    center: {lat: 40.429507, lng: -3.708384}
  });
  //directionsDisplay.setMap(map);
  //directionsDisplay.setPanel(document.getElementById("directions-panel"));
  document.getElementById('submit').addEventListener('click', function() {
    calculateAndDisplayRoute(directionsService, map);
  }); 
    
}

/**
 * Calculo y representación de la ruta
 * @param {type} directionsService
 * @param {type} map
 */
function calculateAndDisplayRoute(directionsService, map) {
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
        travelMode: google.maps.TravelMode.DRIVING,
        provideRouteAlternatives: true
	}

  directionsService.route(request, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      //for(r=0;r<response.routes.length;r++) muestra varias rutas
      for (var r=0; r<1;r++)//provisionalmente solo obtenemos la primera ruta
      {    
            new google.maps.DirectionsRenderer({
                map: map,
                directions: response,
                routeIndex: r,
                
            });
            //directionsDisplay.setDirections(response);
      }
      var summaryPanel = document.getElementById('directions-panel');
      summaryPanel.innerHTML = '';
      //////////////////////////////////////////////////////////////////////////////
      //for (var r=0; r<response.routes.length;r++)//pruebas para obtener varias rutas
      for (var r=0; r<1;r++)//provisionalmente solo obtenemos la primera ruta
      {
      var route = response.routes[r];
      var ruta=r+1;
      //summaryPanel.innerHTML +='<b>RUTA '+ruta+'</b><br>'; provisionalmente solo obtenemos una ruta
      
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
        summaryPanel.innerHTML += 'DISTANCIA TOTAL: ' + Math.round(total/1000) + ' Km<br><br>';
      }
    } else {
          status='no identificar uno o más destinos';
          window.alert('La búsqueda de ruta falló por ' + status);
    }
    //summaryPanel.innerHTML += 'DISTANCIA TOTAL: ' + Math.round(total/1000) + ' Km<br><br>';
    document.getElementById('validar').disabled=false;
    
    document.getElementById('km').value=Math.round(total/1000);
  });  
  
}


/**
 * Auto borrado de elemento
 * @param {type} elemento: elemento del DOM a borrar
 */
function borrar(elemento)
{
	
	padre = elemento.parentNode;
	abuelo= padre.parentNode;
	abuelo.removeChild(padre);
               
       
        //cargas = document.getElementById(tipo); // 1
        //cargas.removeChild(document.getElementById(div)); // 10
        //document.getElementById('num_etapas').value--;

	
}

/**
 * Agragador de campos input al DOM
 * @param {type} tipo: carga o descarga
 * @returns {undefined}
 */
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

/**
 * Rutina que asignará atributos name a los campos del arbol DOM definitivo
 */
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

/**
 * Mostrar resto de formulario
 */
function mostrar_form()
{
    document.getElementById('datos').style.display = 'block';
    document.getElementById('validar').style.display = 'none';
        
}




