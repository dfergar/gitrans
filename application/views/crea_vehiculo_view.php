
    <div class="cuerpo">
     
        <form action="" method="POST" >   

           <div class="col-md-12" display id="datos" >


               <div class="form-group">

                   <div class="alert alert-danger">
                       <?php echo validation_errors(); ?>
                   </div>

                   <div class="form-inline">  
                       
                        <label for="Tipo_id"></label>
                        <?=form_dropdown('Tipo_id', $this->Vehiculos_model->get_tipos(), set_value('Tipo_id'), 'class="form-control"');?>
                        <label for="Matricula">Matricula</label>
                        <input type="text" name="Matricula" class ="form-control" value="<?=set_value('Matricula')?>" size="50" />
                        <label for="MarcaModelo">Marca/Modelo</label>
                        <input type="text" name="MarcaModelo" class ="form-control" value="<?=set_value('MarcaModelo')?>" size="50" />
                        <label for="Nbastidor">NºBastidor</label>
                        <input type="text" name="Nbastidor" class ="form-control" value="<?=set_value('Nbastidor')?>" size="50" />
                        <label for="Fmatri">Fecha Matriculación</label>
                        <input type="date" name="Fmatri" class ="form-control" value="<?=set_value('Fmatri')?>" size="50" />
                        <label for="Fitv">Próxima ITV</label>
                        <input type="date" name="Fitv" class ="form-control" value="<?=set_value('Fitv')?>" size="50" />
                        <br>

                        <input class="btn btn-success" id="grabar" type="submit" value="Grabar Vehiculo">

                    </div>

                </div> 
            </div>
        </form>   
    </div>
      

    
    
        
     

    
      </body>
</html>