<html>
    <head>
        
    <meta charset="utf-8">
       
    <script src="<?=base_url()?>Assets/js/jquery-1.12.0.js" type="text/javascript"></script>    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqiRaSds9IOleXz7jmBoiPgnZ-CQygVWw&signed_in=true&callback=initMap" async defer></script>
    <script src="<?=base_url()?>Assets/js/rutas.js" type="text/javascript"></script>
    <link rel="stylesheet" href="<?=base_url()?>Assets/css/estilos_maps.css" type="text/css">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
   
    <title>Modificar estado</title>
    </head>
    <body>
        
        
    
     <div id="map" class="col-md-6" <?php if ($_POST):?>style='display:none;'<?php endif;?>></div>  
     
     <form action="" method="POST">   
                
                 <div class="alert alert-danger errores" <?php if (!$_POST):?>style='display:none;'<?php endif;?>>
                    <?php echo validation_errors(); ?>
                </div>
                <div>
                    <label>Estado</label>
                    <?=form_dropdown('Estado', $estados, set_value('Estado'), 'class="form-control"');?>
                 </div>
                <label>Observaciones</label>
                <input type="text" name="Observaciones" id="Observaciones" class ="form-control" value="<?=set_value('Observaciones')?>" size="200">
                <input class="btn btn-success" id="grabar" type="submit" value="Grabar Viaje">

                

            </div>
   
        </div> 
         
     </form>   

      

    
    
        
     

    
      </body>
</html>