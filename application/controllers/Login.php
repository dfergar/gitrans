<?php
class Login extends CI_Controller {
    
    
     function __construct()
   {
       parent::__construct();
             
   }   
    /**
     * Carga de formulario login
     */
    function index()
    {
        
        //$categorias=$this->Productos_model->get_categorias();
        //$cabecera=$this->load->view('cabecera', Array('categorias'=>$categorias), TRUE);
        $cabecera=$this->load->view('cabecera2', Array(), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Usuarios_model');
                
           
        $this->form_validation->set_rules('Usuario', 'Usuario','trim|required|min_length[5]|max_length[12]|callback_ValidarUsuario');
        $this->form_validation->set_rules('Password', 'Contraseña', 'trim|required');
       
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('min_length', 'El campo %s debe teneres un mínimo de 5 caracteres');
        $this->form_validation->set_message('max_length', 'El campo %s debe teneres un máximo de 12 caracteres');
        $this->form_validation->set_message('ValidarUsuario', 'Usuario o contraseña incorrectos');
        
        if ($this->form_validation->run() == FALSE)
        {
            
            $contenido=$this->load->view('login_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            
            $username = $this->input->post('Usuario');
            $usuario = $this->Usuarios_model->GetUsuario($username);
            $data_user=array(
                'Usuario'   =>$usuario->Usuario,
                'idUsuario' =>$usuario->idUsuario, 
                'Perfil'    =>$usuario->Perfil
            ) ;
                                          
            $this->session->set_userdata($data_user); 
            
            /*if($usuario->Perfil=='admin')
            {
                redirect('viajes');
                //$data['title'] = 'Administrador'; 
                //$data['user'] = $username;  // = $this->session->userdata('user');
            }*/
            switch ($usuario->Perfil)
            {
                case 'admin': redirect('viajes');
                    break;
                case 'Conductor': redirect('vehiculos');
                    break;
                case 'Operador': redirect('viajes');
                    break;
               
                //$data['title'] = 'Administrador'; 
                //$data['user'] = $username;  // = $this->session->userdata('user');
            }
            
        }
    }
        
    /**
     * Comprobación de validez del login
     * @return boolean
     */    
    public function ValidarUsuario()
    {

        $user=$_POST['Usuario'];
        //$pass=sha1($_POST['Password']);para codificar pass
        $pass=$_POST['Password'];


        if($this->Usuarios_model->ValidarUsuario($user,$pass)) return TRUE;
        else return FALSE;

    }
        
    /**
     * Cierre de sesión
     */
    function CerrarSesion()
    {

        session_destroy();
        redirect('login');
    }
        
    
}
?>

