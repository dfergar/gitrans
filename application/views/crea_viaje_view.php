<html>
    <head>
        <title>REGISTRO DE VIAJES</title>
    </head>
    <body>
        <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
        </div>
        
        
        <form action="" method="POST">
            <div class="form-group">
            <label>Tractora</label>
            <?=form_dropdown('Tractora_id', $this->Viajes_model->get_vehiculos(), set_value('Tractora_id'), 'class="form-control"');?>
            <label>Remolque</label>
            <?=form_dropdown('Remolque_id', $this->Viajes_model->get_vehiculos(), set_value('Remolque_id'), 'class="form-control"');?>
            <label>Conductor 1</label>
            <?=form_dropdown('Conductor1_id', $this->Viajes_model->get_conductores(), set_value('Conductor_id'), 'class="form-control"');?>
            <label>Conductor 2</label>
            <?=form_dropdown('Conductor2_id', $this->Viajes_model->get_conductores(), set_value('Conductor2_id'), 'class="form-control"');?>
            <label>Origen</label>
            <input type="text" name="Origen" class ="form-control" value="<?=set_value('Origen')?>" size="50" readonly/>
            <label>Destino</label>
            <input type="text" name="Destino" class ="form-control" value="<?=set_value('Destino')?>" size="50" readonly/>
            <label>Kms</label>
            <input type="number" name="KM" class ="form-control" value="<?=set_value('KM')?>" size="50" readonly/>
            <label>Cliente</label>
            <?=form_dropdown('Cliente_id', $this->Viajes_model->get_clientes(), set_value('Cliente_id'), 'class="form-control"');?>
            <label>Precio</label>
            <input type="number" name="Precio" class ="form-control" value="<?=set_value('Precio')?>" size="50"/>
            <label>Estado</label>
            <input type="text" name="Estado" class ="form-control" value="<?=set_value('Estado')?>" size="50" />
            <label>Observaciones</label>
            <input type="text" name="Observaciones" class ="form-control" value="<?=set_value('Observaciones')?>" size="50" />
            
            

            
            <div><input type="submit" value="Enviar" /></div>
            </div>
        </form>
    </body>
</html>