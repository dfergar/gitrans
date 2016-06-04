<html>
    <head>
        
    <meta charset="utf-8">
       
    <script src="<?=base_url()?>Assets/js/jquery-1.12.0.js" type="text/javascript"></script>    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqiRaSds9IOleXz7jmBoiPgnZ-CQygVWw&signed_in=true&callback=initMap" async defer></script>
    <script src="<?=base_url()?>Assets/js/rutas.js" type="text/javascript"></script>
    <link rel="stylesheet" href="<?=base_url()?>Assets/css/estilos_maps.css" type="text/css">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
   
    <title>Creador de rutas</title>
    </head>
    <body>
        
        
    
        <div id="map" class="col-md-6" <?php if ($_POST):?>style='display:none;'<?php endif;?>></div>  

        <form action="" method="POST" onsubmit="nombrar();">   
           <div id="right-panel" class="col-md-3" <?php if ($_POST):?>style='display:none;'<?php endif;?>>


                   <div id="ruta" >

                       <h3>SELECCIONAR RUTA</h3>
                       <label>ORIGEN</label>
                       <br>
                       <input type="text" name="Origen" id="start" placeholder="calle, cp, ciudad, país..." />
                       <br><br>
                       <label>CARGAS</label> 
                       <button type="button" id="addcarga" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>

                       <br>

                       <div id="cargas" style="font-size: 18px;"></div>
                       <br>


                       <label>DESCARGAS</label>
                       <button type="button" id="adddescarga" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>

                       <br>

                       <div id="descargas" style="font-size: 18px;"></div>
                       <br>

                       <label>DESTINO</label>
                       <input type="text" name="Destino" id="end" placeholder="calle, cp, ciudad, país..." />
                       <br><br>

                       <input id="ncargas" name="ncargas" type="hidden" value="0" />
                       <input id="ndescargas" name="ndescargas" type="hidden" value="0" />
                       <input type="hidden" id="Precio" name="Precio">
                       <input id="km" name="KM" type="hidden"> 
                       <input class="btn btn-success" id="submit" value="Comprobar ruta">

                       <input class="btn btn-success" type="submit" id="validar" name="validar" value="Validar ruta" disabled>



                   </div>

           </div>
           <div id="directions-panel" class="col-md-2" <?php if ($_POST):?>style='display:none;'<?php endif;?>></div>


        </form>  
    </body>
</html>