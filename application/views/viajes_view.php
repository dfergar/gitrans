<div class="cuerpo">
   <a class="btn btn-primary" href="<?=site_url('Viajes/Crea_ruta')?>">Nuevo</a>
<table class="table">
    
        <tr>
        <th>Viaje</th>
        <th>Tractora</th>
        <th>Remolque</th>
        <th>Chófer 1</th>
        <th>Chófer 2</th>
        <th>Origen</th>
        <th>Destino</th>
        <th>Km</th>
        <th>Cliente</th>
        <th>Precio</th>
        <th>Estado</th>
        <th>Obs</th>  
    </tr>
    
 <?php foreach ($viajes as $items): ?>

    
    
    <tr>
        <td><?=$items->idViaje ?></td>
        <td><?=$this->Viajes_model->get_vehiculo($items->Tractora_id)->Matricula ?></td>
        <td><?=$this->Viajes_model->get_vehiculo($items->Remolque_id)->Matricula ?></td>
        <td><?=$this->Conductores_model->get_conductor($items->Conductor1_id)->Nombre ?></td>         
        <td><?php if (isset($this->Conductores_model->get_conductor($items->Conductor2_id)->Nombre)):echo $this->Conductores_model->get_conductor($items->Conductor2_id)->Nombre;endif;?></td>
        <td><?=$items->Origen ?></td>
        <td><?=$items->Destino ?></td>
        <td><?=$items->KM ?></td>
        <td><?=$this->Clientes_model->get_cliente($items->Cliente_id)->Nombre ?></td>    
        <td><?=$items->Precio ?></td>
        <td><?=$items->Estado ?></td>
        <td><?=$items->Observaciones ?></td>
               
        
    </tr>
 

      






<?php endforeach; ?>
      </table>
   <div class="row">
       <div class="col-md-12" style="text-align: center"><?php echo $this->pagination->create_links() ?></div>
   </div>  
</div>
