<div class="cuerpo">
   <?php  if($this->session->userdata('Perfil')=='admin'):?>
    <a class="btn btn-primary" href="<?=site_url('Conductores/Crea_conductor')?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
    <?php endif;?>
<table class="table">
    
        <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Teléfono</th>
    </tr>
    
 <?php foreach ($conductores as $items): ?>

    
    
    <tr>
        <td><?=$items->idConductor ?></td>
        <td><?=$items->Nombre ?></td>
        <td><?=$items->Apellidos ?></td>
        <td><?=$items->Telefono ?></td>
        <?php  if($this->session->userdata('Perfil')=='admin'):?>
        <td><a class="btn btn-danger" href="<?=site_url('Conductores/Modifica_conductor/'.$items->idConductor)?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
        <?php endif;?>   
    </tr>
    
<?php endforeach; ?>
      </table>
   <div class="row">
       <div class="col-md-12" style="text-align: center"><?php echo $this->pagination->create_links() ?></div>
   </div>  
</div>
