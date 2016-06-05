<?php

class Usuarios extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       if($this->session->userdata('Perfil')!='admin') redirect('login');
      
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
        
        function Crea_Usuario()
    {
        
                
        $categoria="Usuarios";
        $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');    
            
        $this->form_validation->set_rules('Usuario', 'Usuario','trim|required');
                
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        
        
                
        if ($this->form_validation->run() == FALSE)
        {
            $contenido=$this->load->view('crea_usuario_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            
            $datos=array(                
                
                'Usuario'       => $_POST['Usuario'],
                'Password'      => $_POST['Password'],
                'Perfil'        => $_POST['Perfil']
                
            );
            
            $this->Usuarios_model->Insert_Usuario($datos);
            
            
            redirect('usuarios');
            
           
            
        }
    }
        
    function Modifica_Usuario($id)
    {
        
        
        $categoria="Usuarios";
        $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');  
        
        if(!$_POST)
        {
            $usuario=$this->Usuarios_model->get_usuario($id);
            $_POST['Usuario']=$usuario->Usuario;
            $_POST['Password']=$usuario->Password;
            $_POST['Perfil']=$usuario->Perfil;    
            
        }
        
        $this->form_validation->set_rules('Usuario', 'Usuario','trim|required');
                
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        
        
                
        if ($this->form_validation->run() == FALSE)
        {
            $contenido=$this->load->view('crea_usuario_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            
            $datos=array(                
                
                'Usuario'       => $_POST['Usuario'],
                'Password'      => $_POST['Password'],
                'Perfil'        => $_POST['Perfil']
                
            );            
            
            $this->Usuarios_model->Update_Usuario($id, $datos);
            
            
            redirect('usuarios');
            
           
            
        }
    }
    
   
  
   
}
?>

