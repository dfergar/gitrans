<div class="cuerpo">
   <a class="btn btn-primary" href="<?=site_url('Clientes/Crea_cliente')?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
<table class="table">
    
        <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>CIF</th>
        <th>Domicilio</th>
        <th>CP</th>
        <th>Población</th>
        <th>Provincia</th>
        <th>Teléfono</th>
        <th>Email</th>
    </tr>
    
 <?php foreach ($clientes as $items): ?>

    
    
    <tr>
        <td><?=$items->idCliente ?></td>
        <td><?=$items->Nombre ?></td>
        <td><?=$items->CIF ?></td>
        <td><?=$items->Domicilio ?></td>
        <td><?=$items->CP ?></td>
        <td><?=$items->Poblacion ?></td>
        <td><?=$this->Usuarios_model->get_provincia($items->Provincia);?></td>
        <td><?=$items->Telefono ?></td>
        <td><?=$items->Email ?></td>
        <td><a class="btn btn-danger" href="<?=site_url('Clientes/Modifica_cliente/'.$items->idCliente)?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
    </tr>
    
<?php endforeach; ?>
      </table>
   <div class="row">
       <div class="col-md-12" style="text-align: center"><?php echo $this->pagination->create_links() ?></div>
   </div>  
</div>
