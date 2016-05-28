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
                    <input id="km" name="KM" type="hidden" value="0" />
                    
                    <input class="btn btn-success" id="submit" value="Comprobar ruta">
                    <br><br>
                    <input class="btn btn-success" id="validar" name="validar" value="Validar ruta" disabled>
                
                
                   
                </div>
                
        </div>
        <div id="directions-panel" class="col-md-2" <?php if ($_POST):?>style='display:none;'<?php endif;?>></div>
        <div class="col-md-12" display id="datos" <?php if (!$_POST):?>style='display:none;'<?php endif;?>>
            

            <div class="form-group">
                
                <div class="alert alert-danger">
                    <?php echo validation_errors(); ?>
                </div>

                <label>Tractora</label>
                <?=form_dropdown('Tractora_id', $this->Viajes_model->get_vehiculos(), set_value('Tractora_id'), 'class="form-control"');?>
                <label>Remolque</label>
                <?=form_dropdown('Remolque_id', $this->Viajes_model->get_vehiculos(), set_value('Remolque_id'), 'class="form-control"');?>
                <label>Conductor 1</label>
                <?=form_dropdown('Conductor1_id', $this->Viajes_model->get_conductores(), set_value('Conductor_id'), 'class="form-control"');?>
                <label>Conductor 2</label>
                <?=form_dropdown('Conductor2_id', $this->Viajes_model->get_conductores(), set_value('Conductor2_id'), 'class="form-control"');?>
                <?php if ($_POST):?>
                    <label>Origen</label>
                    <input type="text" name="Origen" class ="form-control" value="<?=set_value('Origen')?>" size="50" readonly/>
                    <?php if($_POST['ncargas']>0):?>
                        <input name="ncargas" type="hidden" value="<?=set_value('ncargas')?>"/>                        
                        <fieldset>
                            <legend>Cargas posteriores</legend>
                            <?php for ($i=0;$i<$_POST['ncargas'];$i++):?>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <input type="text" style="margin-left:30px" name="carga<?=$i?>" class ="form-control" value="<?=set_value('carga'.$i)?>" size="50" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <input type="date" class ="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Hora</label>
                                        <input type="time" class ="form-control" />
                                    </div>                                
                                </div>
                            <?php endfor;?>
                        </fieldset>
                    <?php endif;?>
                    <?php if($_POST['ndescargas']>0):?>
                        <input name="ndescargas" type="hidden" value="<?=set_value('ndescargas')?>"/>
                        <fieldset>
                            <legend>Descargas anteriores</legend>                        
                            <?php for ($i=0;$i<$_POST['ndescargas'];$i++):?>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <input type="text" style="margin-left:30px" name="descarga<?=$i?>" class ="form-control" value="<?=set_value('descarga'.$i)?>" size="50" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <input type="date" class ="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Hora</label>
                                        <input type="time" class ="form-control" />
                                    </div>                                
                                </div>                        
                            <?php endfor;?>
                        </fieldset>
                    <?php endif;?>
                    <label>Destino</label>
                    <input type="text" name="Destino" class ="form-control" value="<?=set_value('Destino')?>" size="50" readonly/>
                    <label>Kms</label>                
                    <input type="number" name="KM" class ="form-control" value="<?=set_value('KM')?>" size="50" readonly/>

                    <?php endif;?>
                    <label>Cliente</label>
                <?=form_dropdown('Cliente_id', $this->Viajes_model->get_clientes(), set_value('Cliente_id'), 'class="form-control"');?>
                <label>Precio</label>
                <input type="number" name="Precio" class ="form-control" value="<?=set_value('Precio')?>" size="50"/>
                <label>Estado</label>
                <input type="text" name="Estado" class ="form-control" value="<?=set_value('Estado')?>" size="50" />
                <label>Observaciones</label>
                <input type="text" name="Observaciones" class ="form-control" value="<?=set_value('Observaciones')?>" size="50" />
                <input class="btn btn-success" type="submit" value="Grabar Viaje">

                

            </div>
   
        </div> 
         
     </form>   

      

    
    
        
     

    
      </body>
</html>