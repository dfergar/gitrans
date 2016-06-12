<?php

class Clientes_model extends CI_Model{

   function __construct()
   {
       parent::__construct();
       $this->load->database();
   }
           
   /*function get_clientes($por_pagina,$segmento) 
   {
        $consulta = $this->db->query("SELECT * FROM Cliente LIMIT $segmento, $por_pagina");
        $data=array();
        foreach($consulta->result() as $fila)
        {
            $data[] = $fila;
        }
        return $data; 
   }*/
   
   /**
    * 
    * @param type $por_pagina: elementos por pagina para la paginación
    * @param type $segmento: segmento de la url usado para la paginación
    * @param type $orden: campo por el cual se ordenará el resultado de la condulta
    * @return type: array con los clientes
    */
   function get_clientes($por_pagina,$segmento, $orden) 
   {
        $consulta = $this->db->query("SELECT * FROM Cliente order by $orden asc LIMIT $segmento, $por_pagina");
        $data=array();
        foreach($consulta->result() as $fila)
        {
            $data[] = $fila;
        }
        return $data; 
   }
   
   
   
   
   
   
   
   /**
    * Contador de número de clientes
    * @return type: contador de filas
    */ 
   function filas()
    {
            $consulta = $this->db->query("SELECT count(*) as filas FROM Cliente");
            return  $consulta->row()->filas;
    }
    
    /**
     * Consulta de datos de un cliente
     * @param type $id: id del cliente
     * @return type: fila con los campos del cliente
     */
    function get_cliente($id)
    {
        $consulta = $this->db->query("SELECT * FROM Cliente WHERE idCliente='$id'");
        return $consulta->row();
    }
    
    /**
     * Inserción de cliente
     * @param type $data: array con los datos del cliente
     */
    public function Insert_Cliente($data)
    {
        $this->db->insert('Cliente', $data);
    }
   
        
    /**
     * Modificación de datos del cliente
     * @param type $id: id del cliente
     * @param type $data: array con los nuevos datos del cliente
     */
    public function Update_Cliente($id, $data)
    {
        $this->db->where('idCliente', $id);
        $this->db->update('Cliente', $data);
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
     * Consulta de una provincia por su id
     * @param type $id: id del la provincia
     * @return type: string con el nombre de la provincia
     */
    function get_provincia($id)
    {
        $consulta = $this->db->query("SELECT * FROM tbl_provincias WHERE cod=$id");
        return $consulta->row()->nombre;
    }
   
   
   
    
}

?>

