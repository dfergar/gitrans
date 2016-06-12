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
     
                $pages=9; //Número de registros mostrados por páginas
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
        
   Function Ver_viaje($id)
   {
                $categoria="Viajes";                
                $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
                $pie=$this->load->view('pie', Array(), TRUE);  
                $viaje=$this->Viajes_model->get_viaje($id);
                $cargas=$this->Viajes_model->get_cargas($id);
                $descargas=$this->Viajes_model->get_descargas($id);
                $contenido=$this->load->view('viaje_view', Array('viaje'=>$viaje, 'cargas' => $cargas, 'descargas' => $descargas), TRUE);
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
        
        $estados=array('REGISTRADO','EN RUTA HACIA CARGA','CARGANDO','EN RUTA HACIA DESCARGA','DESCARGANDO','FINALIZADO');
        
               
        
        if ($this->form_validation->run() == FALSE)
        {
            
            $contenido=$this->load->view('crea_ruta_view',Array('estados' => $estados),true);
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
    
    function Modifica_ruta($id)
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
        
        $estados=array('REGISTRADO','EN RUTA HACIA CARGA','CARGANDO','EN RUTA HACIA DESCARGA','DESCARGANDO','FINALIZADO');
        
        if(!$_POST)
        {
            $viaje=$this->Viajes_model->get_viaje($id);
            $_POST['Tractora_id']   =   $viaje->Tractora_id;
            $_POST['Remolque_id']   =   $viaje->Remolque_id;
            $_POST['Conductor1_id'] =   $viaje->Conductor1_id;
            $_POST['Conductor2_id'] =   $viaje->Conductor2_id;
            $_POST['Cliente']       =   $viaje->Cliente_id;
            $_POST['Precio']        =   $viaje->Precio;
            $_POST['Estado']        =   $viaje->Estado;
            $_POST['Observaciones'] =   $viaje->Observaciones;
           
            $_POST['Origen']        =   $viaje->Origen;
            $_POST['FechaOrigen']   =   $viaje->FechaOrigen;
            $_POST['HoraOrigen']    =   $viaje->HoraOrigen;
            $_POST['Destino']       =   $viaje->Destino;
            $_POST['FechaDestino']  =   $viaje->FechaDestino;
            $_POST['HoraDestino']   =   $viaje->HoraDestino;
            $cargas=$this->Viajes_model->get_cargas($id);
            $descargas=$this->Viajes_model->get_descargas($id);
            $ncargas=$this->Viajes_model->get_ncargas($id);
            $ndescargas=$this->Viajes_model->get_ndescargas($id);
            $_POST['ncargas']=$ncargas;
            $_POST['ndescargas']=$ndescargas;
            $indice=0;
            foreach($cargas as $carga)
            {   
                $_POST['carga'.$indice]=$carga->PobCarga_id;
                $indice++;
            }
            
        }       
        
        if ($this->form_validation->run() == FALSE)
        {
            
            $contenido=$this->load->view('crea_ruta_view',Array('estados' => $estados),true);
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
    
    
    
    
    /*public function ExisteUsuario($user)
    {

       if($this->Usuarios_model->ExisteUsuario($user)) return FALSE; 
       else return TRUE;

    }  
    */
    function Modifica_viaje($id)
    {
        
        
        $categoria="Viajes";
        $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');  
        
        if(!$_POST)
        {
            $viaje=$this->Viajes_model->get_viaje($id);
            $_POST['Tractora_id']   =   $viaje->Tractora_id;
            $_POST['Remolque_id']   =   $viaje->Remolque_id;
            $_POST['Conductor1_id'] =   $viaje->Conductor1_id;
            $_POST['Conductor2_id'] =   $viaje->Conductor2_id;
            $_POST['Cliente']       =   $viaje->Cliente;
            $_POST['Precio']        =   $viaje->Precio;
            $_POST['Estado']        =   $viaje->Estado;
            $_POST['Observaciones'] =   $viaje->Observaciones;
            
        }
        
        $this->form_validation->set_rules('Precio', 'Precio','trim|required|numeric');
                
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('numeric', 'El campo %s debe ser numérico');
        
        
                
        if ($this->form_validation->run() == FALSE)
        {
            $contenido=$this->load->view('Modifica_viaje_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            
            $datos=array(                
                
            'Tractora_id'   =>  $_POST['Tractora_id'],  
            'Remolque_id'   =>  $_POST['Remolque_id'],  
            'Conductor1_id' =>  $_POST['Conductor1_id'],
            'Conductor2_id' =>  $_POST['Conductor2_id'],
            'Cliente'       =>  $_POST['Cliente'],
            'Precio'        =>  $_POST['Precio'],
            'Estado'        =>  $_POST['Estado'],
            'Observaciones' =>  $_POST['Observaciones']
                
            );
            
            $this->Viajes_model->Update_Viaje($id, $datos);
            
            
            redirect('viajes');
            
           
            
        }
    }
        
    function Modifica_rutar($id)
    {
        
        
        $categoria="Viajes";
        $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');  
        
        if(!$_POST)
        {
            $viaje=$this->Viajes_model->get_viaje($id);            
            $_POST['Origen']        =   $viaje->Origen;
            $_POST['FechaOrigen']   =   $viaje->FechaOrigen;
            $_POST['HoraOrigen']    =   $viaje->HoraOrigen;
            $_POST['Destino']       =   $viaje->Destino;
            $_POST['FechaDestino']  =   $viaje->FechaDestino;
            $_POST['HoraDestino']   =   $viaje->HoraDestino;
            $cargas=$this->Viajes_model->get_cargas($id);
            $descargas=$this->Viajes_model->getdes_cargas($id);
        }
        
                
        
                
        if ($this->form_validation->run() == FALSE)
        {
            $contenido=$this->load->view('modifica_ruta_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            
            $datos=array(                
                
           
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
            
            $this->Viajes_model->Update_Viaje($id, $datos);
                                 
            $this->Viajes_model->Delete_etapas_viaje($id);
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
    
    
    
   
}
?>
