<div class="cuerpo">
    <?php  if($this->session->userdata('Perfil')=='admin'||$this->session->userdata('Perfil')=='Operador'):?>
    <a  href="<?=site_url('Viajes/Crea_ruta')?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><img src="<?=base_url()?>Assets/icons/rutas.png" width="40" aria-hidden="true"></img></a>
    <a class="btn btn-primary" href="<?=site_url('Viajes/facturados')?>"><span>FACTURADOS</span></a>
    <a class="btn btn-primary" href="<?=site_url('Viajes/anulados')?>"><span>ANULADOS</span></a>
        <?php endif;?>

<table class="table table-bordered table-striped table-condensed">
    
        <tr>
            <th width="3%"><a href="<?=$sentido=='asc'?site_url('Viajes/index/0/'.'idViaje/desc'):site_url('Viajes/index/0/'.'idViaje/asc')?>">Viaje</a></th>
            <th width="7%"><a href="<?=$sentido=='asc'?site_url('Viajes/index/0/'.'FechaOrigen/desc'):site_url('Viajes/index/0/'.'FechaOrigen/asc')?>">Fecha</a></th>
            <th width="7%"><a href="<?=$sentido=='asc'?site_url('Viajes/index/0/'.'Tractora_id/desc'):site_url('Viajes/index/0/'.'Tractora_id/asc')?>">Tractora</a></th>
            <th width="7%"><a href="<?=$sentido=='asc'?site_url('Viajes/index/0/'.'Remolque_id/desc'):site_url('Viajes/index/0/'.'Remolque_id/asc')?>">Remolque</a></th>
            <th width="7%"><a href="<?=$sentido=='asc'?site_url('Viajes/index/0/'.'Conductor1_id/desc'):site_url('Viajes/index/0/'.'Conductor1_id/asc')?>">Chófer1</a></th>
            <th width="7%"><a href="<?=$sentido=='asc'?site_url('Viajes/index/0/'.'Conductor2_id/desc'):site_url('Viajes/index/0/'.'Conductor2_id/asc')?>">Chófer2</th>
            <th width="15%"><a href="<?=$sentido=='asc'?site_url('Viajes/index/0/'.'Origen/desc'):site_url('Viajes/index/0/'.'Origen/asc')?>">Origen</a></th>
            <th width="15%"><a href="<?=$sentido=='asc'?site_url('Viajes/index/0/'.'Destino/desc'):site_url('Viajes/index/0/'.'Destino/asc')?>">Destino</a></th>
            <th width="3%"><a href="<?=$sentido=='asc'?site_url('Viajes/index/0/'.'KM/desc'):site_url('Viajes/index/0/'.'KM/asc')?>">Km</a></th>
            <th width="15%"><a href="<?=$sentido=='asc'?site_url('Viajes/index/0/'.'Cliente_id/desc'):site_url('Viajes/index/0/'.'Cliente_id/asc')?>">Cliente</a></th>
            <th width="6%"><a href="<?=$sentido=='asc'?site_url('Viajes/index/0/'.'Precio/desc'):site_url('Viajes/index/0/'.'Precio/asc')?>">Precio</a></th>
            <th width="8%"><a href="<?=$sentido=='asc'?site_url('Viajes/index/0/'.'Origen/desc'):site_url('Viajes/index/0/'.'Origen/asc')?>">Estado</a></th>
        
    </tr>
    
 <?php foreach ($viajes as $items): ?>

    
    
    <tr>
        <td><?=$items->idViaje ?></td>
        <td nowrap><?=date("d-m-y", strtotime($items->FechaOrigen))?></td>
        <td><?=$this->Viajes_model->get_vehiculo($items->Tractora_id)->Matricula ?></td>
        <td><?=$this->Viajes_model->get_vehiculo($items->Remolque_id)->Matricula ?></td>
        <td><?=$this->Conductores_model->get_conductor($items->Conductor1_id)->Nombre ?></td>         
        <td><?php if (isset($this->Conductores_model->get_conductor($items->Conductor2_id)->Nombre)):echo $this->Conductores_model->get_conductor($items->Conductor2_id)->Nombre;endif;?></td>
        <td><?=$items->Origen ?></td>
        <td><?=$items->Destino ?></td>
        <td><?=$items->KM ?></td>
        <td><?=$this->Clientes_model->get_cliente($items->Cliente_id)->Nombre ?></td>  
        <td><?=$this->session->userdata('Perfil')=='admin' || $this->session->userdata('Perfil')=='Operador'?$items->Precio:"Oculto";?></td>
        <td><?=$items->Estado ?></td>
        <td><a class="btn btn-info" href="<?=site_url('Viajes/Ver_viaje/'.$items->idViaje)?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
               
        
    </tr>
 

      






<?php endforeach; ?>
      </table>
   <div class="row">
       <div class="col-md-12" style="text-align: center"><?php echo $this->pagination->create_links() ?></div>
   </div>  
</div>
