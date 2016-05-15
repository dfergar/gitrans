<html>
    <head>
        
    <meta charset="utf-8">
       
    <script src="<?=base_url()?>Assets/js/jquery-1.12.0.js" type="text/javascript"></script>    
        
    <script src="<?=base_url()?>Assets/js/rutas.js" type="text/javascript"></script>
    <link rel="stylesheet" href="<?=base_url()?>Assets/css/estilos_maps.css" type="text/css">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Creador de rutas</title>
  </head>
    <body>
        <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
        </div>
        
        
        <?php echo "";/*<form action="" method="POST">
            <div class="form-group">
            <label>Origen</label>
            <input type="text" name="Origen" id="start" class ="form-control" placeholder="calle, cp, ciudad, país..." value="<?=set_value('Origen')?>" size="50" />
            <label>Destino</label>
            <input type="text" name="Destino" id=·end" class ="form-control" placeholder="calle, cp, ciudad, país..." value="<?=set_value('Destino')?>" size="50" />
            
            
            <?php echo "";/*<?=form_dropdown('Provincia', $this->Viajes_model->get_provincias(), set_value('Provincia'), 'class="form-control"');?>?>

            
            <div><input type="submit" value="Comprobar ruta" /></div>
            </div>
        </form>*/?>
        
       
      <div id="map"></div>  
    <div id="right-panel">
      <div>
          
          <h3>SELECCIONAR RUTA</h3>
                <label>ORIGEN</label>
    		<input type="text" name="start" id="start" placeholder="calle, cp, ciudad, país..." />
                <br><br>
    		<label>CARGAS</label> 
                <button id="addcarga" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
    		<!--<button id="delcarga" disabled=true>Eliminar carga</button>-->
                <br>
        
                <div id="cargas" style="font-size: 18px;"></div>
                <br>

		    
		    <label>DESCARGAS</label>
    		 <button id="adddescarga" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
    		<!--<button id="deldescarga" disabled=true>Eliminar descarga</button>-->
    		<br>

    		<div id="descargas" style="font-size: 18px;"></div>
                <br>
    		
    		<label>DESTINO</label>
    		<input type="text" name="end" id="end" placeholder="calle, cp, ciudad, país..." />
    		

		<input class="btn btn-success" type="submit" id="submit" value="Comprobar ruta">
            

      </div>
    
    </div>
      <div id="directions-panel"></div>
     

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqiRaSds9IOleXz7jmBoiPgnZ-CQygVWw&signed_in=true&callback=initMap" async defer></script>
   
    </body>
</html>