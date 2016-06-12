<?php

class Estadisticas extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       if(!$this->session->userdata('Perfil')) redirect('login');
       
      
   }
   
    
   //En construcción
   function index()
	{
		
                
                $categoria="Estadísticas";
                $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
                $pie=$this->load->view('pie', Array(), TRUE);               
     
                
                $contenido=$this->load->view('estadisticas_view',Array(),true);
                $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
                
               
	}
   
   
        
   
}
?>
