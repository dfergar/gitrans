<?php

class Viajes extends CI_Controller {

   function __construct()
   {
       parent::__construct();
        if(!$this->session->userdata('Perfil')) redirect('login');
      
   }
   
    
   
   function index($comienzo=0)
	{
		
                
                $categoria="Viajes";
                $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
                $pie=$this->load->view('pie', Array(), TRUE);               
     
                $pages=12; //Número de registros mostrados por páginas
		$this->load->library('pagination'); //Cargamos la librería de paginación
		$config['base_url'] = site_url('viajes/index'); // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
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
   
   function Crea_ruta()
   {
        $categoria="Viajes";
        $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Viajes_model');
        
        $this->form_validation->set_rules('Precio', 'Precio','trim|required|numeric');
        $this->form_validation->set_rules('fechaorigen', 'Fecha de llegada al origen del viaje','trim|required');
        
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('numeric', 'El campo %s debe ser numérico');
        
        
        
        if ($this->form_validation->run() == FALSE)
        {
            $contenido=$this->load->view('crea_ruta_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            
            $datos=array(                
                
                'Tractora_id'   => $_POST['Tractora_id'],
                'Remolque_id'   => $_POST['Remolque_id'],
                'Conductor1_id' => $_POST['Conductor1_id'],
                'Conductor2_id' => $_POST['Conductor2_id'],
                'Origen'        => $_POST['Origen'],
                'FechaOrigen'   => $_POST['fechaorigen'],
                'HoraOrigen'    => $_POST['horaorigen'],
                'Destino'       => $_POST['Destino'],
                'FechaDestino'  => $_POST['fechadestino'],
                'HoraDestino'   => $_POST['horadestino'],
                'KM'            => $_POST['KM'],
                'Cliente_id'    => $_POST['Cliente_id'],
                'Precio'        => $_POST['Precio'],
                'Estado'        => $_POST['Estado'],
                'Observaciones' => $_POST['Observaciones']
            );
            
            $this->Viajes_model->Insert_Viaje($datos);
            
            $id=$this->Viajes_model->Ultimo_Viaje();
            for ($i=0;$i<$_POST['ncargas'];$i++)
            {
                $data=array(
                    'Viaje_id_carga'    => $id,
                    'FechaCarga'        => $_POST['fechacarga'.$i],
                    'HoraCarga'         => $_POST['horacarga'.$i],
                    'PobCarga_id'       => $_POST['carga'.$i]
                );
                $this->Viajes_model->Insert_Carga($data);
                
            }
            for ($i=0;$i<$_POST['ndescargas'];$i++)
            {
                $data=array(
                    'Viaje_id_descarga'    => $id,
                    'FechaDescarga'        => $_POST['fechadescarga'.$i],
                    'HoraDescarga'         => $_POST['horadescarga'.$i],
                    'PobDescarga_id'       => $_POST['descarga'.$i]
                );
                $this->Viajes_model->Insert_Descarga($data);
            }
            
            
            redirect('viajes');
            
           
            
        }
        
       
    }
    
    function Crea_viaje($data)
    {
        
        print_r($data);
        $_POST['Origen']=$data['origen'];
        $_POST['Destino']=$data['destino'];
        $_POST['KM']=$data['KM'];    
        
        $cabecera=$this->load->view('cabecera', Array(), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
        
              
        
            
         $this->form_validation->set_rules('Precio', 'Precio','trim|required');
        
                
          /* 
        $this->form_validation->set_rules('Usuario', 'Usuario','trim|required|min_length[5]|max_length[12]|callback_ExisteUsuario');
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
            $contenido=$this->load->view('crea_viaje_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            $datos=array(
                'Tractora_id'   => $_POST['Tractora_id'],
                'Remolque_id'   => $_POST['Remolque_id'],
                'Conductor1_id' => $_POST['Conductor1_id'],
                'Conductor2_id' => $_POST['Conductor2_id'],
                'Origen'        => $_POST['Origen'],
                'Destino'       => $_POST['Destino'],
                'KM'            => $_POST['KM'],
                'Cliente_id'    => $_POST['Cliente_id'],
                'Precio'        => $_POST['Precio'],
                'Estado'        => $_POST['Estado'],
                'Observaciones' => $_POST['Observaciones']
            );
            
            $this->Viajes_model->Insert_Viaje($datos);
            
            
            redirect('viajes');
            
        }
       
    }
    
    public function valid_dni($str)
    {
        $str = trim($str);  
        $str = str_replace("-","",$str);  
        $str = str_ireplace(" ","",$str);

        if ( !preg_match("/^[0-9]{7,8}[a-zA-Z]{1}$/" , $str) )
        {
                return FALSE;
        }
        else
        {
                $n = substr($str, 0 , -1);		
                $letter = substr($str,-1);
                $letter2 = substr ("TRWAGMYFPDXBNJZSQVHLCKE", $n%23, 1); 
                if(strtolower($letter) != strtolower($letter2))
                        return FALSE;
        }
        return TRUE;
    }

    public function ExisteUsuario($user)
    {

       if($this->Usuarios_model->ExisteUsuario($user)) return FALSE; 
       else return TRUE;

    }  
   
}
?>
