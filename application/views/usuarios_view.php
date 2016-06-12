<div class="cuerpo">
    <a class="btn btn-primary" href="<?=site_url('Usuarios/Crea_usuario')?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
<table class="table table-bordered table-striped table-condensed">
    
        <tr>
        <th><a href="<?=site_url('Usuarios/index/0/'.'idUsuario')?>">Código</a></th>
        <th><a href="<?=site_url('Usuarios/index/0/'.'Usuario')?>">Usuario</a></th>
        <th><a href="<?=site_url('Usuarios/index/0/'.'Password')?>">Password</a></th>
        <th><a href="<?=site_url('Usuarios/index/0/'.'Perfil')?>">Perfil</a></th>
    </tr>
    
 <?php foreach ($usuarios as $items): ?>

    
    
    <tr>
        <td><?=$items->idUsuario ?></td>
        <td><?=$items->Usuario ?></td>
        <td><?=$items->Password ?></td>
        <td><?=$items->Perfil ?></td>
        <td><a class="btn btn-danger" href="<?=site_url('Usuarios/Modifica_usuario/'.$items->idUsuario)?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
    </tr>
    
<?php endforeach; ?>
      </table>
   <div class="row">
       <div class="col-md-12" style="text-align: center"><?php echo $this->pagination->create_links() ?></div>
   </div>  
</div>
