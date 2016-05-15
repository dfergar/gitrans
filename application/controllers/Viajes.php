<?php

class Viajes extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       
      
   }
   
    
   
   function index($comienzo=0)
	{
		
                //$categorias=$this->Productos_model->get_categorias();
                //$cabecera=$this->load->view('cabecera', Array('categorias'=>$categorias), TRUE);
                $cabecera=$this->load->view('cabecera', Array(), TRUE);
                $pie=$this->load->view('pie', Array(), TRUE);               
     
                $pages=4; //Número de registros mostrados por páginas
		$this->load->library('pagination'); //Cargamos la librería de paginación
		$config['base_url'] = site_url('productos/index'); // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
		$config['total_rows'] = $this->Viajes_model->filas();//calcula el número de filas  
		$config['per_page'] = $pages; //Número de registros mostrados por páginas
                $config['num_links'] = 20; //Número de links mostrados en la paginación
 		$config['first_link'] = 'Primera';//primer link
		$config['last_link'] = 'Última';//último link
                $config["uri_segment"] = 3;//el segmento de la paginación
		$config['next_link'] = 'Siguiente';//siguiente link
		$config['prev_link'] = 'Anterior';//anterior link
		$this->pagination->initialize($config); //inicializamos la paginación
                
		$cuerpo = $this->Viajes_model->get_viajes($config['per_page'],$comienzo);	
                $contenido=$this->load->view('viajes_view',Array('viajes'=>$cuerpo),true);
                $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
                
               
	}
   
   function Crea_viaje()
   {
       
        $cabecera=$this->load->view('cabecera', Array(), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        //$this->load->model('Viajes_model');
                
           
        /*$this->form_validation->set_rules('Usuario', 'Usuario','trim|required|min_length[5]|max_length[12]|callback_ExisteUsuario');
        $this->form_validation->set_rules('Password', 'Contraseña','trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Confirmar Contraseña', 'trim|required');
        $this->form_validation->set_rules('Nombre', 'Nombre','trim|required');
        $this->form_validation->set_rules('Apellidos', 'Apellidos','required');
        $this->form_validation->set_rules('Dni', 'DNI', 'required|callback_valid_dni');
        $this->form_validation->set_rules('Correo', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('Direccion', 'Dirección','required');
        $this->form_validation->set_rules('CodigoPostal', 'Código Postal','required|numeric|exact_length[5]');
         
        
        
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('ExisteUsuario', 'El nombre de usuaro ya existe en la base de datos, escoja otro');
        $this->form_validation->set_message('min_length', 'El campo %s debe teneres un mínimo de 5 caracteres');
        $this->form_validation->set_message('max_length', 'El campo %s debe teneres un máximo de 12 caracteres');
        $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
        $this->form_validation->set_message('valid_email', 'El campo %s no tiene un formato válido');
        $this->form_validation->set_message('valid_dni', 'El campo %s no tiene un formato válido');
        $this->form_validation->set_message('exact_length', 'El campo $s no tiene 5 digitos');
        $this->form_validation->set_message('numeric', 'El campo %s debe ser exclusivamente numérico');*/

        

        if ($this->form_validation->run() == FALSE)
        {
            //$this->load->view('registro_view');
            $contenido=$this->load->view('crea_viaje_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            $data=array(/*
                'Usuario' => $_POST['Usuario'],
                'Password' => sha1($_POST['Password']),
                'Nombre' => $_POST['Nombre'],
                'Apellidos' =>$_POST['Apellidos'],
                'Estado' => $_POST['Estado'],
                'Dni' => $_POST['Dni'],
                'Correo' => $_POST['Correo'],
                'Direccion' => $_POST['Direccion'],
                'CodigoPostal' => $_POST['CodigoPostal'],
                'Provincia' => $_POST['Provincia']*/
            );
            $this->Viajes_model->Insert_Usuario($data);
            
            
            redirect('Viajes');
            
        }
       
    }
   
        
   function ver_categoria($categoria, $comienzo=0)
   {
        $categorias=$this->Productos_model->get_categorias();
        $cabecera=$this->load->view('cabecera', Array('categorias'=>$categorias, 'categoria'=>$categoria),  TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);
        
        $pages=4; //Número de registros mostrados por páginas
        $this->load->library('pagination'); //Cargamos la librería de paginación
        $config['base_url'] = site_url('productos/ver_categoria/'.$categoria); // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $this->Productos_model->filas_categoria($categoria);//calcula el número de filas  
        $config['per_page'] = $pages; //Número de registros mostrados por páginas
        $config['num_links'] = 20; //Número de links mostrados en la paginación
        $config['first_link'] = 'Primera';//primer link
        $config['last_link'] = 'Última';//último link
        $config["uri_segment"] = 4;//el segmento de la paginación
        $config['next_link'] = 'Siguiente';//siguiente link
        $config['prev_link'] = 'Anterior';//anterior link
        $this->pagination->initialize($config); //inicializamos la paginación		
        //$cuerpo = $this->Productos_model->total_paginados($config['per_page'],$comienzo);
                
        $cuerpo=$this->Productos_model->get_prod_categoria($categoria, $config['per_page'],$comienzo);
        $contenido=$this->load->view('productos_view',Array('productos'=>$cuerpo),true);
       
        $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
   }
   
   function detalle($id)
   {
        $categorias=$this->Productos_model->get_categorias();
        $cabecera=$this->load->view('cabecera', Array('categorias'=>$categorias),  TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);
        
        $cuerpo=$this->Productos_model->get_prod_id($id);
        $contenido=$this->load->view('detalle_view',Array('detalles'=>$cuerpo),true);
       
        $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
   }
   
   
   
}
?>
