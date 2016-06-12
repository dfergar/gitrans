
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
                        <label for="CIF">CIF</label>
                        <input type="text" name="CIF" class ="form-control" value="<?=set_value('CIF')?>" size="50" />
                        <label for="Domicilio">Domicilio</label>
                        <input type="text" name="Domicilio" class ="form-control" value="<?=set_value('Domicilio')?>" size="50" />
                        <label for="CP">CP</label>
                        <input type="text" name="CP" class ="form-control" value="<?=set_value('CP')?>" size="50" />
                        <label for="Poblacion">Poblacion</label>
                        <input type="text" name="Poblacion" class ="form-control" value="<?=set_value('Poblacion')?>" size="50" />
                        <label for="Provincia">Provincia</label>
                        <?=form_dropdown('Provincia', $this->Usuarios_model->get_provincias(), set_value('Provincia'), 'class="form-control"');?>
                        <br>
                        <label for="Telefono">Teléfono</label>
                        <input type="text" name="Telefono" class ="form-control" value="<?=set_value('Telefono')?>" size="50" />
                        <label for="Email">Email</label>
                        <input type="text" name="Email" class ="form-control" value="<?=set_value('Email')?>" size="50" />
                        <br>

                        <input class="btn btn-success" id="grabar" type="submit" value="Grabar Cliente">

                    </div>

                </div> 
            </div>
        </form>   
    </div>
      

    
    
        
     

    
      </body>
</html>