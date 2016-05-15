<?php
class Usuarios_model extends CI_Model{
   
    function get_provincias()
    {
        $consulta = $this->db->query("select cod, nombre from tbl_provincias");
        $provincias=array();
        foreach($consulta->result_array() as $fila)
        {
            $provincias[$fila['cod']]=$fila['nombre'];
        }
        return $provincias;
    }
    
    function get_provincia($id)
    {
        $consulta = $this->db->query("SELECT * FROM tbl_provincias WHERE cod=$id");
        return $consulta->row()->nombre;
    }
    
    function ValidarUsuario($user,$password)
    {         //   Consulta Mysql para buscar en la tabla Usuario aquellos usuarios que coincidan con el mail y password ingresados en pantalla de login
        $query = $this->db->where('Usuario',$user);   //   La consulta se efectúa mediante Active Record. Una manera alternativa, y en lenguaje más sencillo, de generar las consultas Sql.
        $query = $this->db->where('Password',$password);
        $query = $this->db->get('Usuario');
        
        return $query->row();    //   Devolvemos al controlador la fila que coincide con la búsqueda. (FALSE en caso que no existir coincidencias)
    }
   
    function ExisteUsuario($usuario)
    {
        $query = $this->db->where('Usuario',$usuario);  
        $query = $this->db->get('Usuario');
        return $query->row();
    }
   
   
   
    public function Insert_Usuario($data)
    {
        $this->db->insert('Usuario', $data);
    }
    
    public function GetUsuario($usuario)
    {
        $consulta = $this->db->query("SELECT * FROM Usuario WHERE Usuario='$usuario'");
        return $consulta->row();
       
    }
    
    public function UpdateUsuario($id, $data)
    {
        $this->db->where('idUsuario', $id);
        $this->db->update('Usuario', $data);
    }
    
    public function DeleteUsuario($id)
    {
        $this->db->delete('Usuario', array('idUsuario' => $id));
    }
    
    function GetPedidos($id)
    {
        $consulta=$this->db->query("SELECT * FROM Pedido WHERE Usuario_idUsuario=$id");
        return $consulta->result();
        
    }
    
    function SetPassword($user, $pass)
    {
        $this->db->query("UPDATE Usuario SET Password='$pass' WHERE Usuario='$user'");
    }
            
}
?>

