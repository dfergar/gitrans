<?php
class Registro extends CI_Controller {
    function index()
    {
        $categorias=$this->Productos_model->get_categorias();
        $cabecera=$this->load->view('cabecera', Array('categorias'=>$categorias), TRUE);
        $pie=$this->load->view('pie', Array(), TRUE);         

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Usuarios_model');
                
           
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
        $this->form_validation->set_message('numeric', 'El campo %s debe ser exclusivamente numérico');

        

        if ($this->form_validation->run() == FALSE)
        {
            //$this->load->view('registro_view');
            $contenido=$this->load->view('registro_view',Array(),true);
            $this->load->view('plantilla_view',Array('cabecera'=>$cabecera, 'contenido'=>$contenido,'pie'=>$pie));
            
        }
        else
        {
            $data=array(
                'Usuario' => $_POST['Usuario'],
                'Password' => sha1($_POST['Password']),
                'Nombre' => $_POST['Nombre'],
                'Apellidos' =>$_POST['Apellidos'],
                'Estado' => $_POST['Estado'],
                'Dni' => $_POST['Dni'],
                'Correo' => $_POST['Correo'],
                'Direccion' => $_POST['Direccion'],
                'CodigoPostal' => $_POST['CodigoPostal'],
                'Provincia' => $_POST['Provincia']
            );
            $this->Usuarios_model->Insert_Usuario($data);
            $username = $this->input->post('Usuario');
            $data_user = array('Usuario'=> $username);
             
                                      
            $this->session->set_userdata($data_user); 
            
            redirect('productos');
            
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
