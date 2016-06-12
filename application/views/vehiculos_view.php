<div class="cuerpo">
   <?php  if($this->session->userdata('Perfil')=='admin'):?>
   <a  href="<?=site_url('Vehiculos/Crea_vehiculo')?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><img src="<?=base_url()?>Assets/icons/camion.png" width="40" aria-hidden="true"></img></a>
   <?php endif;?>
   <table class="table table-bordered table-striped table-condensed">
    
        <tr>
        <th><a href="<?=site_url('Vehiculos/index/0/'.'idVehiculo')?>">Código</a></th>
        <th><a href="<?=site_url('Vehiculos/index/0/'.'Tipo_id')?>">Tipo</a></th>
        <th><a href="<?=site_url('Vehiculos/index/0/'.'Matricula')?>">Matrícula</a></th>
        <th><a href="<?=site_url('Vehiculos/index/0/'.'MarcaModelo')?>">Marca/Modelo</a></th>
        <th><a href="<?=site_url('Vehiculos/index/0/'.'Nbastidor')?>">Núm Bastidor</a></th>
        <th><a href="<?=site_url('Vehiculos/index/0/'.'Fmatri')?>">Fecha matriculación</a></th>
        <th><a href="<?=site_url('Vehiculos/index/0/'.'Fitv')?>">Próxima ITV</a></th>
        
    </tr>
    
 <?php foreach ($vehiculos as $items): ?>

    
    
    <tr>
        <td><?=$items->idVehiculo ?></td>
        <td><?=$this->Vehiculos_model->get_tipo($items->Tipo_id);?></td>       
        <td><?=$items->Matricula ?></td>
        <td><?=$items->MarcaModelo ?></td>         
        <td><?=$items->Nbastidor ?></td>
        <td><?=date("d-m-Y", strtotime($items->Fmatri)); ?></td>
        <td <?php if($items->Fitv<=date("Y-m-d",now())):?>class="parpadea"<?php endif;?>><?=date("d-m-Y", strtotime($items->Fitv)); ?></td>
        <?php  if($this->session->userdata('Perfil')=='admin'):?>
        <td><a class="btn btn-danger" href="<?=site_url('Vehiculos/Modifica_vehiculo/'.$items->idVehiculo)?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
        <?php endif;?>
    </tr>
    
<?php endforeach; ?>
      </table>
   <div class="row">
       <div class="col-md-12" style="text-align: center"><?php echo $this->pagination->create_links() ?></div>
   </div>  
</div>
