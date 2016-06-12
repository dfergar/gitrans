<?php
class Usuarios_model extends CI_Model{
   
    function __construct()
   {
       parent::__construct();
       $this->load->database();
   }
           
   /**
    * Consulta de los usuarios paginada
    * @param type $por_pagina: nuemero de registros por página
    * @param type $segmento: sergmento de la url usado por la paginación
    * @param type $orden: campo por el cual se ordenará la consulta
    * @return type: array con los datos de los usuarios
    */
   function get_usuarios($por_pagina,$segmento, $orden) 
   {
        $consulta = $this->db->query("SELECT * FROM Usuario ORDER BY $orden asc LIMIT $segmento, $por_pagina");
        $data=array();
        foreach($consulta->result() as $fila)
        {
            $data[] = $fila;
        }
        return $data; 
   } 
   
    
    
    //obtenemos el total de filas para hacer la paginación
    function filas()
    {
            $consulta = $this->db->query("SELECT count(*) as filas FROM Usuario");
            return  $consulta->row()->filas;
    }
    
    /**
     * Consulta de provincias
     * @return type: array con las provincias
     */
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
        
    /**
     * Consulta de usuario y su password
     * @param type $user: usuario
     * @param type $password: password
     * @return type: fila con los datos del usuario
     */
    function ValidarUsuario($user,$password)
    {         //   Consulta Mysql para buscar en la tabla Usuario aquellos usuarios que coincidan con el mail y password ingresados en pantalla de login
        $query = $this->db->where('Usuario',$user);   //   La consulta se efectúa mediante Active Record. Una manera alternativa, y en lenguaje más sencillo, de generar las consultas Sql.
        $query = $this->db->where('Password',$password);
        $query = $this->db->get('Usuario');
        
        return $query->row();    //   Devolvemos al controlador la fila que coincide con la búsqueda. (FALSE en caso que no existir coincidencias)
    }
   
    /**
     * Consulta de un usuario
     * @param type $usuario: usuario
     * @return type: fila con los datos del usuario
     */
    function ExisteUsuario($usuario)
    {
        $query = $this->db->where('Usuario',$usuario);  
        $query = $this->db->get('Usuario');
        return $query->row();
    }
   
   
   
    /**
     * Iserción de usuarios
     * @param type $data: datos del usuario
     */
    public function Insert_Usuario($data)
    {
        $this->db->insert('Usuario', $data);
    }
    
    /**
     * Consulta de usuario
     * @param type $usuario
     * @return type: fila con los datos del usuario
     */
    public function GetUsuario($usuario)
    {
        $consulta = $this->db->query("SELECT * FROM Usuario WHERE Usuario='$usuario'");
        return $consulta->row();
       
    }
    
    /**
     * Modificar usuario
     * @param type $id: id del usuario
     * @param type $data: array con los datos del usuario
     */
    public function Update_Usuario($id, $data)
    {
        $this->db->where('idUsuario', $id);
        $this->db->update('Usuario', $data);
    }
    
    /**
     * Borrado de usuario
     * @param type $id: id del usuario
     */
    public function DeleteUsuario($id)
    {
        $this->db->delete('Usuario', array('idUsuario' => $id));
    }
        
    /**
     * Cambio de password
     * @param type $user: usuario
     * @param type $pass: password
     */
    function SetPassword($user, $pass)
    {
        $this->db->query("UPDATE Usuario SET Password='$pass' WHERE Usuario='$user'");
    }
    
    /**
     * Consulta de provincias
     * @param type $id: id del suario
     * @return type: fila con los datos de la provincia
     */
    function get_provincia($id)
    {
        $consulta = $this->db->query("SELECT * FROM tbl_provincias WHERE cod=$id");
        return $consulta->row()->nombre;
    }
    
     /**
     * Consulta de usuario
     * @param type $usuario: id del usuario
     * @return type: fila con los datos del usuario
     */
    function get_usuario($id)
    {
        $consulta = $this->db->query("SELECT * FROM Usuario WHERE idUsuario='$id'");
        return $consulta->row();
    }
    
    
            
}
?>

