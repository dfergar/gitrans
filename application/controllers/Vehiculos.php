<?php

class Vehiculos extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       if(!$this->session->userdata('Perfil')) redirect('login');
      
   }
   
    
   
   function index($comienzo=0, $orden="idVehiculo")
	{
		
                
                $categoria="Vehiculos";               
                $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
                $pie=$this->load->view('pie', Array(), TRUE);   
     
                $pages=4; //Número de registros mostrados por páginas
		$this->load->library('pagination'); //Cargamos la librería de paginación
		$config['base_url'] = site_url('vehiculos/index'); // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
		$config['total_rows'] = $this->Vehiculos_model->filas();//calcula el número de filas  
		$config['per_page'] = $pages; //Número de registros mostrados por páginas
                $config['num_links'] = 20; //Número de links mostrados en la paginación
 		$config['first_link'] = 'Primera';//primer link
		$config['last_link'] = 'Última';//último link
                $config["uri_segment"] = 3;//el segmento de la paginación
		$config['next_link'] = 'Siguiente';//siguiente link
		$config['prev_link'] = 'Anterior';//anterior link
		$this->pagination->initialize($config); //inicializamos la paginación
                
		$cuerpo = $this->Vehiculos_model->get_vehiculos($config['per_page'],$comienzo, $orden);	
                $contenido=$this->load->view('vehiculos_view',Array('vehiculos'=>$cuerpo),true);
                $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
                
               
	}
        
        function Crea_Vehiculo()
    {
        
                
        $categoria="Vehiculos";
        $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');    
            
        $this->form_validation->set_rules('Matricula', 'Matricula','trim|required');
                
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        
        
                
        if ($this->form_validation->run() == FALSE)
        {
            $contenido=$this->load->view('crea_vehiculo_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
           
            $datos=array(                
                
                'Tipo_id'       => $_POST['Tipo_id'],
                'Matricula'     => $_POST['Matricula'],
                'MarcaModelo'   => $_POST['MarcaModelo'],
                'Nbastidor'     => $_POST['Nbastidor'],
                'Fmatri'        => $_POST['Fmatri'],
                'Fitv'          => $_POST['Fitv']
                
                
            );
            
            $this->Vehiculos_model->Insert_Vehiculo($datos);
            
            
            redirect('vehiculos');
            
           
            
        }
    }
        
    function Modifica_Vehiculo($id)
    {
        
        
        $categoria="Vehiculos";
        $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');  
        
        if(!$_POST)
        {
            $vehiculo=$this->Vehiculos_model->get_vehiculo($id);
            $_POST['Tipo_id']   =   $vehiculo->Tipo_id;
            $_POST['Matricula'] =   $vehiculo->Matricula;
            $_POST['MarcaModelo'] = $vehiculo->MarcaModelo;
            $_POST['Nbastidor'] =   $vehiculo->Nbastidor;
            $_POST['Fmatri'] =      $vehiculo->Fmatri;
            $_POST['Fitv'] =        $vehiculo->Fitv;
        }
        
        $this->form_validation->set_rules('Matricula', 'Matricula','trim|required');
                
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        
        
                
        if ($this->form_validation->run() == FALSE)
        {
            $contenido=$this->load->view('crea_vehiculo_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            
            $datos=array(                
                
                'Tipo_id'       =>   $_POST['Tipo_id'],
                'Matricula'     =>   $_POST['Matricula'],
                'MarcaModelo'   =>   $_POST['MarcaModelo'],
                'Nbastidor'     =>   $_POST['Nbastidor'],  
                'Fmatri'        =>   $_POST['Fmatri'],     
                'Fitv'          =>   $_POST['Fitv']       
                
            );
            
            $this->Vehiculos_model->Update_Vehiculo($id, $datos);
            
            
            redirect('vehiculos');
            
           
            
        }
    }
    
    function itv_caducada($fecha)
    {
        if($fecha<=now())
        {
            return true;
        }
        else return false;
    }
        
    
   
  
   
}
?>

