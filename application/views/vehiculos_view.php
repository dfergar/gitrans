<div class="cuerpo">
  
   <a class="btn btn-default" href="<?=site_url('Vehiculos/Crea_vehiculo')?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><img src="<?=base_url()?>Assets/icons/camion.png" width="40" aria-hidden="true"></img></a>
   
   <table class="table">
    
        <tr>
        <th>Código</th>
        <th>Tipo</th>
        <th>Matrícula</th>
        <th>Marca/Modelo</th>
        <th>Núm Bastidor</th>
        <th>Fecha matriculación</th>
        <th>Próxima ITV</th>
        <th>Km</th>        
    </tr>
    
 <?php foreach ($vehiculos as $items): ?>

    
    
    <tr>
        <td><?=$items->idVehiculo ?></td>
        <td><?=$this->Vehiculos_model->get_tipo($items->Tipo_id);?></td>       
        <td><?=$items->Matricula ?></td>
        <td><?=$items->MarcaModelo ?></td>         
        <td><?=$items->Nbastidor ?></td>
        <td><?=date("d-m-Y", strtotime($items->Fmatri)); ?></td>
        <td><?=date("d-m-Y", strtotime($items->Fitv)); ?></td>
        <td><a class="btn btn-danger" href="<?=site_url('Vehiculos/Modifica_vehiculo/'.$items->idVehiculo)?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
    </tr>
    
<?php endforeach; ?>
      </table>
   <div class="row">
       <div class="col-md-12" style="text-align: center"><?php echo $this->pagination->create_links() ?></div>
   </div>  
</div>
