 <div class="cuerpo">
    <?php  if($this->session->userdata('Perfil')=='admin' || $this->session->userdata('Perfil')=='Operador'):?>
    <a  href="<?=site_url('Viajes/Crea_ruta')?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><img src="<?=base_url()?>Assets/icons/rutas.png" width="40" aria-hidden="true"></a>
    <a  href="<?=site_url('Viajes/Modifica_ruta/'.$viaje->idViaje)?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><img src="<?=base_url()?>Assets/icons/rutas.png" width="40" aria-hidden="true"></a>
   
    <?php elseif($this->session->userdata('Perfil')=='Conductor'):?>
    <a  href="<?=site_url('Viajes/Modifica_estado/'.$viaje->idViaje)?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span><img src="<?=base_url()?>Assets/icons/rutas.png" width="40" aria-hidden="true"></a>
        <?php endif;?>

<table class="table table-bordered table-striped table-hover table-condensed">
    
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
        
    </tr>
    
    <tr>
        <td><?=$viaje->idViaje ?></td>
        <td><?=$this->Viajes_model->get_vehiculo($viaje->Tractora_id)->Matricula ?></td>
        <td><?=$this->Viajes_model->get_vehiculo($viaje->Remolque_id)->Matricula ?></td>
        <td><?=$this->Conductores_model->get_conductor($viaje->Conductor1_id)->Nombre ?></td>         
        <td><?php if (isset($this->Conductores_model->get_conductor($viaje->Conductor2_id)->Nombre)):echo $this->Conductores_model->get_conductor($viaje->Conductor2_id)->Nombre;endif;?></td>
        <td><?=$viaje->Origen ?></td>
        <td><?=$viaje->Destino ?></td>
        <td><?=$viaje->KM ?></td>
        <td><?=$this->Clientes_model->get_cliente($viaje->Cliente_id)->Nombre ?></td>  
        <td><?=$this->session->userdata('Perfil')=='admin' || $this->session->userdata('Perfil')=='Operador'?$viaje->Precio:"Oculto";?></td>
        <td><?=$viaje->Estado ?></td>
     
    </tr>
 
</table>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="panel panel-default">
                     <div class="panel-heading">
                        <div class="container">
                            <div class='row'>
                                <div class='col-md-5 text-center'><h4>CARGAS</h4></div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="container">
                            <div class='row'>
                                    <div class='col-md-2'><?=$viaje->Origen?></div>
                                    <div class='col-md-2'><?=date("d-m-Y", strtotime($viaje->FechaOrigen))?></div>
                                    <div class='col-md-2'><?=substr($viaje->HoraOrigen,0,5)?></div>
                                </div>
                            <?php if(count($cargas>0)):foreach($cargas as $carga):?>
                                <div class='row'>
                                    <div class='col-md-2'><?=$carga->PobCarga_id?></div>
                                    <div class='col-md-2'><?=date("d-m-Y", strtotime($carga->FechaCarga))?></div>
                                    <div class='col-md-2'><?=substr($carga->HoraCarga,0,5)?></div>                                    
                                </div>
                            <?php endforeach;endif;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="container">
                            <div class='row'>
                                <div class='col-md-5 text-center'><h4>DESCARGAS</h4></div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="container">                            
                            <?php if(count($descargas>0)):foreach($descargas as $descarga):?>
                                <div class='row'>
                                    <div class='col-md-2'><?=$descarga->PobDescarga_id?></div>
                                    <div class='col-md-2'><?=date("d-m-Y", strtotime($descarga->FechaDescarga))?></div>                                    
                                    <div class='col-md-2'><?=substr($descarga->HoraDescarga,0,5)?></div>
                                </div>
                            <?php endforeach;endif;?>
                            <div class='row'>
                                    <div class='col-md-2'><?=$viaje->Destino?></div>
                                    <div class='col-md-2'><?=date("d-m-Y", strtotime($viaje->FechaDestino))?></div>
                                    <div class='col-md-2'><?=substr($viaje->HoraDestino,0,5)?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>OBSERVACIONES</h4></div>
                    <div class="panel-body"><?=$viaje->Observaciones?></div>

 </div>