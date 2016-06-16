<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/css/gitrans_estilos.css"/>
        
        <script src="<?=base_url()?>Assets/js/jquery-1.12.0.js" type="text/javascript"></script>
        
        
    </head>
    <body>
        <div class="container"><?=$cabecera?></div>
        
        <div class="container" ><?=$contenido?></div>
        <div class="container"><?php //echo $this->pagination->create_links() ?></div>
        
        <div clas="container"><?=$pie?></div>        
        
       
    </body>
</html>






