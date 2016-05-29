<div class="cuerpo">
   <a class="btn btn-primary" href="<?=site_url('Vehiculos/Crea_vehiculo')?>">Nuevo</a>
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
        <td><?=$items->Tipo_id ?></td>
        <td><?=$items->Matricula ?></td>
        <td><?=$items->MarcaModelo ?></td>         
        <td><?=$items->Nbastidor ?></td>
        <td><?=$items->Fmatri ?></td>
        <td><?=$items->Fitv ?></td>
    </tr>
    
<?php endforeach; ?>
      </table>
   <div class="row">
       <div class="col-md-12" style="text-align: center"><?php echo $this->pagination->create_links() ?></div>
   </div>  
</div>
