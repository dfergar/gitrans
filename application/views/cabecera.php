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

<div class="container">
  <div class="page-header">
      <a href="<?=site_url()?>" style="text-decoration:none;"><h1>GITRANS Gestión Integral del Transporte</h1></a>    
  </div>
</div>

<div class="container-fluid">
   
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
          
          <li <?php if(!isset($categoria)):?>class="active"<?php endif;?>>
              <a href="<?=base_url()?>index.php">Viajes</a>
          </li>
                
      </ul>
        
        
        
        
      
      <ul class="nav navbar-nav navbar-right">
            
          <?php if (null !==$this->session->userdata('Usuario')):?>
                    <li><a href="<?=site_url('usuario/ver_usuario/'.$this->session->userdata('Usuario'))?>"><?=$this->session->userdata('Usuario')?></a> </li>
                    <li><a href="<?=site_url('login/CerrarSesion');?>">Cerrar sesión</a></li>
          <?php else:?>
                    <li><a href="<?=site_url('registro')?>">Registro</a></li>
                    <li><a href="<?=site_url('login')?>">Login</a></li>
                    
          <?php endif?>
                    
                    
                        
                 
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>

