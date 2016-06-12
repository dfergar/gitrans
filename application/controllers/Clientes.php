<?php

class Clientes extends CI_Controller {

   function __construct()
   {
       parent::__construct();
       if(!$this->session->userdata('Perfil')) redirect('login');
       
      
   }
   
    
   /**
    * Listado de clientes paginado
    * @param type $comienzo: primer resultado de la pagina
    * @param type $orden: campo por el cual se ordenará la consulta
    */
   function index($comienzo=0, $orden='idCliente')
	{
		
                
                $categoria="Clientes";
                $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
                $pie=$this->load->view('pie', Array(), TRUE);               
     
                $pages=12; //Número de registros mostrados por páginas
		$this->load->library('pagination'); //Cargamos la librería de paginación
		$config['base_url'] = site_url('clientes/index'); // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
		$config['total_rows'] = $this->Clientes_model->filas();//calcula el número de filas  
		$config['per_page'] = $pages; //Número de registros mostrados por páginas
                $config['num_links'] = 20; //Número de links mostrados en la paginación
 		$config['first_link'] = 'Primera';//primer link
		$config['last_link'] = 'Última';//último link
                $config["uri_segment"] = 3;//el segmento de la paginación
		$config['next_link'] = 'Siguiente';//siguiente link
		$config['prev_link'] = 'Anterior';//anterior link
		$this->pagination->initialize($config); //inicializamos la paginación
                
		$cuerpo = $this->Clientes_model->get_clientes($config['per_page'],$comienzo, $orden);	
                $contenido=$this->load->view('clientes_view',Array('clientes'=>$cuerpo),true);
                $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
                
               
	}
   
   /**
    * Creación de clientes
    */
        function Crea_Cliente()
    {
        
                
        $categoria="Clientes";
        $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');    
            
        $this->form_validation->set_rules('Nombre', 'Nombre','trim|required');       
        $this->form_validation->set_rules('CIF', 'CIF', 'required|callback_valid_cif');
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('Domicilio', 'Domicilio','required');
        $this->form_validation->set_rules('CP', 'CP','required|numeric|exact_length[5]');
         
        
        
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('valid_email', 'El campo %s no tiene un formato válido');
        $this->form_validation->set_message('valid_cif', 'El campo %s no tiene un formato válido');
        $this->form_validation->set_message('exact_length', 'El campo $s no tiene 5 digitos');
        $this->form_validation->set_message('numeric', 'El campo %s debe ser exclusivamente numérico');
        
        
                
        if ($this->form_validation->run() == FALSE)
        {
            $contenido=$this->load->view('crea_cliente_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            
            $datos=array(                
                
                'Nombre'        => $_POST['Nombre'],
                'CIF'           => $_POST['CIF'],
                'Domicilio'     => $_POST['Domicilio'],
                'CP'            => $_POST['CP'],
                'Poblacion'     => $_POST['Poblacion'],
                'Provincia'     => $_POST['Provincia'],
                'Telefono'      => $_POST['Telefono'],
                'Email'         => $_POST['Email']
                
            );
            
            $this->Clientes_model->Insert_Cliente($datos);
            
            
            redirect('clientes');
            
           
            
        }
    }
        
    /**
     * Modificar cliente
     * @param type $id: id del cliente
     */
    function Modifica_Cliente($id)
    {
        
        
        $categoria="Clientes";
        $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');  
        
        if(!$_POST)
        {
            $cliente=$this->Clientes_model->get_cliente($id);
            $_POST['Nombre']=$cliente->Nombre;
            $_POST['CIF']=$cliente->CIF;
            $_POST['Domicilio']=$cliente->Domicilio;           
            $_POST['CP']=$cliente->CP;
            $_POST['Poblacion']=$cliente->Poblacion;
            $_POST['Provincia']=$cliente->Provincia;
            $_POST['Telefono']=$cliente->Telefono;
            $_POST['Email']=$cliente->Email;
            
        }
        
        $this->form_validation->set_rules('Nombre', 'Nombre','trim|required');
                
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        
        
                
        if ($this->form_validation->run() == FALSE)
        {
            $contenido=$this->load->view('crea_cliente_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            
            $datos=array(                
                
                'Nombre'        => $_POST['Nombre'],
                'CIF'           => $_POST['CIF'],
                'Domicilio'     => $_POST['Domicilio'],
                'CP'            => $_POST['CP'],
                'Poblacion'     => $_POST['Poblacion'],
                'Provincia'     => $_POST['Provincia'],
                'Telefono'      => $_POST['Telefono'],
                'Email'         => $_POST['Email']
                
            );
            
            $this->Clientes_model->Update_Cliente($id, $datos);
            
            
            redirect('clientes');
            
           
            
        }
    }
    
    /**
     * Comprobador de formato de CIF de empresa
     * @param type $str: cadena correspondiente al CIF
     * @return boolean
     */
    public function valid_cif($str)
    {
        $str = trim($str);  
        $str = str_replace("-","",$str);  
        $str = str_ireplace(" ","",$str);

        if ( !preg_match("/^[a-zA-Z]{1}[0-9]{7,8}$/" , $str) )
        {
                return FALSE;
        }
        else    return TRUE;
    }
        
   
}
?>
