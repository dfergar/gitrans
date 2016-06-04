<?php

class Usuarios extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       
      
   }
   
    
   
   function index($comienzo=0)
	{
		
                
                $categoria="Usuarios";
                $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
                $pie=$this->load->view('pie', Array(), TRUE);   
     
                $pages=4; //Número de registros mostrados por páginas
		$this->load->library('pagination'); //Cargamos la librería de paginación
		$config['base_url'] = site_url('usuarios/index'); // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
		$config['total_rows'] = $this->Usuarios_model->filas();//calcula el número de filas  
		$config['per_page'] = $pages; //Número de registros mostrados por páginas
                $config['num_links'] = 20; //Número de links mostrados en la paginación
 		$config['first_link'] = 'Primera';//primer link
		$config['last_link'] = 'Última';//último link
                $config["uri_segment"] = 3;//el segmento de la paginación
		$config['next_link'] = 'Siguiente';//siguiente link
		$config['prev_link'] = 'Anterior';//anterior link
		$this->pagination->initialize($config); //inicializamos la paginación
                
		$cuerpo = $this->Usuarios_model->get_usuarios($config['per_page'],$comienzo);	
                $contenido=$this->load->view('usuarios_view',Array('usuarios'=>$cuerpo),true);
                $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
                
               
	}
        
    
   
  
   
}
?>

