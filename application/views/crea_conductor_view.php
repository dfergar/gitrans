
    <div class="cuerpo">
     
        <form action="" method="POST" >   

           <div class="col-md-12" display id="datos" >


               <div class="form-group">

                   <div class="alert alert-danger errores" <?php if (!$_POST):?>style='display:none;'<?php endif;?>>
                       <?php echo validation_errors(); ?>
                   </div>

                   <div class="form-inline">  
                       
                        <label for="Nombre">Nombre</label>
                        <input type="text" name="Nombre" class ="form-control" value="<?=set_value('Nombre')?>" size="50" />
                        <label for="Apellidos">Apellidos</label>
                        <input type="text" name="Apellidos" class ="form-control" value="<?=set_value('Apellidos')?>" size="50" />
                        <label for="Telefono">Teléfono</label>
                        <input type="text" name="Telefono" class ="form-control" value="<?=set_value('Telefono')?>" size="50" />
                        <br>

                        <input class="btn btn-success" id="grabar" type="submit" value="Grabar Conductor">

                    </div>

                </div> 
            </div>
        </form>   
    </div>
      

    
    
        
     

    
      </body>
</html>