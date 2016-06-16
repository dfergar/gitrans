<?php

class Viajes extends CI_Controller {

   function __construct()
   {
       parent::__construct();
        if(!$this->session->userdata('Perfil')) redirect('login');
      
   }
   
    
   /**
    * Listado de visjes paginado de viajes no facturados
    * @param type $comienzo: primer resultado de la pagina
    * @param type $orden: campo por el cual se ordenará la consulta
    */
   function index($comienzo=0, $orden="FechaOrigen", $sentido="desc")
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
                
		$cuerpo = $this->Viajes_model->get_viajes($config['per_page'],$comienzo, $orden, $sentido);	
                $contenido=$this->load->view('viajes_view',Array('viajes'=>$cuerpo,'sentido'=>$sentido),true);
                $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
                
               
	}
        
        /**
         * Listado de visjes paginado de viajes facturados
        * @param type $comienzo: primer resultado de la pagina
        * @param type $orden: campo por el cual se ordenará la consulta
         */
        function facturados($comienzo=0, $orden="FechaOrigen", $sentido="desc")
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
                
		$cuerpo = $this->Viajes_model->get_viajes_facturados($config['per_page'],$comienzo, $orden);	
                $contenido=$this->load->view('viajes_view',Array('viajes'=>$cuerpo,'sentido'=>$sentido),true);
                $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
                
               
	}
        
        function anulados($comienzo=0, $orden="FechaOrigen", $sentido="desc")
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
                
		$cuerpo = $this->Viajes_model->get_viajes_anulados($config['per_page'],$comienzo, $orden);	
                $contenido=$this->load->view('viajes_view',Array('viajes'=>$cuerpo,'sentido'=>$sentido),true);
                $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
                
               
	}
        
   /**
    * Ver un viaje en detalle
    * @param type $id: id del viaje
    */
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
   
   /**
    * Crear un viaje
    */
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
        $this->form_validation->set_rules('fechadestino', 'Fecha de llegada al destino del viaje','trim|required');
        
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('numeric', 'El campo %s debe ser numérico');
        
        $estados=array('REGISTRADO','EN RUTA HACIA CARGA','CARGANDO','EN RUTA HACIA DESCARGA','DESCARGANDO','FINALIZADO','FACTURADO','ANULADO');
        
               
        
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
                'Estado'        => $estados[$_POST['Estado']],
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
   
   /**
    * Modificar un viaje
    * @param type $id: id del viaje
    */ 
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
        $this->form_validation->set_rules('fechadestino', 'Fecha de llegada al destino del viaje','trim|required');
        
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('numeric', 'El campo %s debe ser numérico');
        
        $estados=array('REGISTRADO','EN RUTA HACIA CARGA','CARGANDO','EN RUTA HACIA DESCARGA','DESCARGANDO','FINALIZADO','FACTURADO','ANULADO');
        
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
            $_POST['KM']            =   $viaje->KM;
            $_POST['Origen']        =   $viaje->Origen;
            $_POST['fechaorigen']   =   $viaje->FechaOrigen;
            $_POST['horaorigen']    =   $viaje->HoraOrigen;
            $_POST['Destino']       =   $viaje->Destino;
            $_POST['fechadestino']  =   $viaje->FechaDestino;
            $_POST['horadestino']   =   $viaje->HoraDestino;
            $cargas=$this->Viajes_model->get_cargas($id);
            $descargas=$this->Viajes_model->get_descargas($id);
            $ncargas=$this->Viajes_model->get_ncargas($id);
            $ndescargas=$this->Viajes_model->get_ndescargas($id);
            $_POST['ncargas']=$ncargas;
            $_POST['ndescargas']=$ndescargas;
            $indice=0;
            foreach($cargas as $carga)
            {   
                $_POST['idcarga'.$indice]=$carga->idCarga;
                $_POST['carga'.$indice]=$carga->PobCarga_id;
                $_POST['fechacarga'.$indice]=$carga->FechaCarga;
                $_POST['horacarga'.$indice]=$carga->HoraCarga;
                
                $indice++;
            }
            $indice=0;
            foreach($descargas as $descarga)
            {   
                $_POST['iddescarga'.$indice]=$descarga->idDescarga;
                $_POST['descarga'.$indice]=$descarga->PobDescarga_id;
                $_POST['fechadescarga'.$indice]=$descarga->FechaDescarga;
                $_POST['horadescarga'.$indice]=$descarga->HoraDescarga;
                $indice++;
            }
            
        }       
        
        if ($this->form_validation->run() == FALSE)
        {
            
            $contenido=$this->load->view('modifica_ruta_view',Array('estados' => $estados),true);
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
                'Estado'        => $estados[$_POST['Estado']],
                'Observaciones' => $_POST['Observaciones']
            );
            
            //Inserción de datos del viaje
            $this->Viajes_model->Update_Viaje($id, $datos);
            
            //Inserción de cargas
            for ($i=0;$i<$_POST['ncargas'];$i++)
            {
                $idcarga=$_POST['idcarga'.$i];
                $data=array(                   
                    'FechaCarga'        => $_POST['fechacarga'.$i],
                    'HoraCarga'         => $_POST['horacarga'.$i],
                    'PobCarga_id'       => $_POST['carga'.$i]
                );
                $this->Viajes_model->Update_Carga($idcarga,$data);
                
            }
            //Iserción de descargas
            for ($i=0;$i<$_POST['ndescargas'];$i++)
            {
                $iddescarga=$_POST['iddescarga'.$i];
                $data=array(
                    'FechaDescarga'        => $_POST['fechadescarga'.$i],
                    'HoraDescarga'         => $_POST['horadescarga'.$i],
                    'PobDescarga_id'       => $_POST['descarga'.$i]
                );
                $this->Viajes_model->Update_Descarga($iddescarga,$data);
            }
            
            
            redirect('viajes');
            
           
            
        }
        
       
    }
    
    /**
     * Mdificar el estado de un viaje(perfil conductor)
     * @param type $id: id del viaje
     */
    function Modifica_estado($id)
    {
        $categoria="Viajes";
        $cabecera=$this->load->view('cabecera', Array('categoria'=>$categoria), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Viajes_model');
        
        $this->form_validation->set_rules('Estado', 'Estado','trim|required');
       
        
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
       
        
        $estados=array('REGISTRADO','EN RUTA HACIA CARGA','CARGANDO','EN RUTA HACIA DESCARGA','DESCARGANDO','FINALIZADO','FACTURADO');
        
        if(!$_POST)
        {
            $viaje=$this->Viajes_model->get_viaje($id);
            
            $_POST['Estado']        =   $viaje->Estado;
            $_POST['Observaciones'] =   $viaje->Observaciones;
        }   
        
        if ($this->form_validation->run() == FALSE)
        {
            
            $contenido=$this->load->view('modifica_estado_view',Array('estados' => $estados),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            
            $datos=array(                
                
                
                'Estado'        => $estados[$_POST['Estado']],
                'Observaciones' => $_POST['Observaciones']
            );
            
            $this->Viajes_model->Update_Viaje($id, $datos);
            
           
            
            
            redirect('viajes');
        }
    
   
    
    
    
    }   
}
