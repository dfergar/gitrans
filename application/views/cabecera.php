<!DOCTYPE html>
<html lang="en">
<head>
  <title>GITRANS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>


  <div class="page-header">
      <a href="<?=site_url()?>" style="text-decoration:none;">
        
          <div class="logo">
              <img class="logo" src="<?=base_url()?>Assets/images/camion_deep.jpg" aria-hidden="true">
          </div>
            <div class="titulo">
             <span class="empresa" >GITRANS</span>
             <span class="actividad">Gestión Integral del Transporte</span>   
            </div> 
        
      </a>
  </div>


<div class="container-fluid cabecera">
   
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    
     <ul class="nav navbar-nav">
        
         <?php if (null !==$this->session->userdata('Usuario')):?>
            <li <?php if(isset($categoria)):if($categoria=="Viajes"):?> class="active"<?php endif; endif; ?>> 
                <a href="<?=site_url('viajes');?>">Viajes</a></li>         
            <li <?php if(isset($categoria)):if($categoria=="Vehiculos"):?> class="active"<?php endif; endif; ?>> 
                <a href="<?=site_url('vehiculos');?>">Vehículos</a></li>
            <li <?php if(isset($categoria)):if($categoria=="Conductores"):?> class="active"<?php endif; endif; ?>> 
                <a href="<?=site_url('conductores');?>">Conductores</a></li>
            <li <?php if(isset($categoria)):if($categoria=="Clientes"):?> class="active"<?php endif; endif; ?>> 
                <a href="<?=site_url('clientes');?>">Clientes</a></li>            
            <?php if($this->session->userdata('Perfil')=='admin'):?>
            <li <?php if(isset($categoria)):if($categoria=="Usuarios"):?> class="active"<?php endif; endif; ?>> 
                <a href="<?=site_url('usuarios')?>">Usuarios</a></li><?php endif;?>  
            <li <?php if(isset($categoria)):if($categoria=="Estadisticas"):?> class="active"<?php endif; endif; ?>> 
                <a href="<?=site_url('estadisticas');?>">Estadísticas</a></li>
         <?php endif;?>
      </ul>
        
        
        
        
        
      
      <ul class="nav navbar-nav navbar-right">
            
          <?php if (null !==$this->session->userdata('Usuario')):?>
                    <li><a href=""><?=$this->session->userdata('Usuario')?></a> </li>
                    <li><a href=""><?=$this->session->userdata('Perfil')?></a> </li>
                    <li><a href="<?=site_url('login/CerrarSesion');?>">Cerrar sesión</a></li>                    
          <?php else:?>
                    
                    <li><a href="<?=site_url('login')?>">Login</a></li>
                    
          <?php endif?>
                    
                    
                        
                 
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>


