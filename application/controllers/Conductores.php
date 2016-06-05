<?php

class Conductores extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       if(!$this->session->userdata('Perfil')) redirect('login');     
      
   }
   
    
   
   function index($comienzo=0)
    {
		
           
        $categoria="Conductores";
        $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);   

        $pages=4; //Número de registros mostrados por páginas
        $this->load->library('pagination'); //Cargamos la librería de paginación
        $config['base_url'] = site_url('vehiculos/index'); // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $this->Conductores_model->filas();//calcula el número de filas  
        $config['per_page'] = $pages; //Número de registros mostrados por páginas
        $config['num_links'] = 20; //Número de links mostrados en la paginación
        $config['first_link'] = 'Primera';//primer link
        $config['last_link'] = 'Última';//último link
        $config["uri_segment"] = 3;//el segmento de la paginación
        $config['next_link'] = 'Siguiente';//siguiente link
        $config['prev_link'] = 'Anterior';//anterior link
        $this->pagination->initialize($config); //inicializamos la paginación

        $cuerpo = $this->Conductores_model->get_conductores($config['per_page'],$comienzo);	
        $contenido=$this->load->view('conductores_view',Array('conductores'=>$cuerpo),true);
        $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
                
               
    }
        
    function Crea_Conductor()
    {
        
                
        $categoria="Conductores";
        $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');    
            
        $this->form_validation->set_rules('Nombre', 'Nombre','trim|required');
                
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        
        
                
        if ($this->form_validation->run() == FALSE)
        {
            $contenido=$this->load->view('crea_conductor_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            
            $datos=array(                
                
                'Nombre'        => $_POST['Nombre'],
                'Apellidos'     => $_POST['Apellidos'],
                'Telefono'      => $_POST['Telefono']
                
            );
            
            $this->Conductores_model->Insert_Conductor($datos);
            
            
            redirect('conductores');
            
           
            
        }
    }
        
    function Modifica_Conductor($id)
    {
        
        
        $categoria="Conductores";
        $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');  
        
        if(!$_POST)
        {
            $conductor=$this->Conductores_model->get_conductor($id);
            $_POST['Nombre']=$conductor->Nombre;
            $_POST['Apellidos']=$conductor->Apellidos;
            $_POST['Telefono']=$conductor->Telefono;
        }
        
        $this->form_validation->set_rules('Nombre', 'Nombre','trim|required');
                
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        
        
                
        if ($this->form_validation->run() == FALSE)
        {
            $contenido=$this->load->view('crea_conductor_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            
            $datos=array(                
                
                'Nombre'        => $_POST['Nombre'],
                'Apellidos'     => $_POST['Apellidos'],
                'Telefono'      => $_POST['Telefono']
                
            );
            
            $this->Conductores_model->Update_Conductor($id, $datos);
            
            
            redirect('conductores');
            
           
            
        }
    }
        
    
   
  
   
}
?>

