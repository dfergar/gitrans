<div class="cuerpo">
   <a class="btn btn-primary" href="<?=site_url('Conductores/Crea_conductor')?>">Nuevo</a>
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
    </tr>
    
<?php endforeach; ?>
      </table>
   <div class="row">
       <div class="col-md-12" style="text-align: center"><?php echo $this->pagination->create_links() ?></div>
   </div>  
</div>
