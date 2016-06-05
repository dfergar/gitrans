<div class="cuerpo">
    <?php  if($this->session->userdata('Perfil')=='admin'):?>
    <a class="btn btn-primary" href="<?=site_url('Clientes/Crea_cliente')?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
    <?php endif;?>
<table class="table">
    
        <tr>
        <th><a href="<?=site_url('Clientes/index/0/'.'idCliente')?>">Código</a></th>
        <th><a href="<?=site_url('Clientes/index/0/'.'Nombre')?>">Nombre</a></th>
        <th><a href="<?=site_url('Clientes/index/0/'.'CIF')?>">CIF</a></th>
        <th><a href="<?=site_url('Clientes/index/0/'.'Domicilio')?>">Domicilio</a></th>
        <th><a href="<?=site_url('Clientes/index/0/'.'CP')?>">CP</a></th>
        <th><a href="<?=site_url('Clientes/index/0/'.'Poblacion')?>">Población</th>
        <th><a href="<?=site_url('Clientes/index/0/'.'Provincia')?>">Provincia</a></th>
        <th><a href="<?=site_url('Clientes/index/0/'.'Telefono')?>">Teléfono</a></th>
        <th><a href="<?=site_url('Clientes/index/0/'.'Email')?>">Email</a></th>
    </tr>
    
 <?php foreach ($clientes as $items): ?>

    
    
    <tr>
        <td><?=$items->idCliente ?></td>
        <td><?=$items->Nombre ?></td>
        <td><?=$items->CIF ?></td>
        <td><?=$items->Domicilio ?></td>
        <td><?=$items->CP ?></td>
        <td><?=$items->Poblacion ?></td>
        <td><?=$this->Clientes_model->get_provincia($items->Provincia);?></td>
        <td><?=$items->Telefono ?></td>
        <td><?=$items->Email ?></td>
        <?php  if($this->session->userdata('Perfil')=='admin'):?>
        <td><a class="btn btn-danger" href="<?=site_url('Clientes/Modifica_cliente/'.$items->idCliente)?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
        <?php endif;?>
    </tr>
    
<?php endforeach; ?>
      </table>
   <div class="row">
       <div class="col-md-12" style="text-align: center"><?php echo $this->pagination->create_links() ?></div>
   </div>  
</div>
