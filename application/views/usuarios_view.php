<div class="cuerpo">
   <a class="btn btn-primary" href="<?=site_url('Conductores/Crea_conductor')?>">Nuevo</a>
<table class="table">
    
        <tr>
        <th>Código</th>
        <th>Usuario</th>
        <th>Password</th>
        <th>Perfil</th>
    </tr>
    
 <?php foreach ($usuarios as $items): ?>

    
    
    <tr>
        <td><?=$items->idUsuario ?></td>
        <td><?=$items->Usuario ?></td>
        <td><?=$items->Password ?></td>
        <td><?=$items->Perfil ?></td>
    </tr>
    
<?php endforeach; ?>
      </table>
   <div class="row">
       <div class="col-md-12" style="text-align: center"><?php echo $this->pagination->create_links() ?></div>
   </div>  
</div>
