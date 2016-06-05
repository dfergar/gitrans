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
   
   
   
   
   
   
   
    function filas()
    {
            $consulta = $this->db->query("SELECT count(*) as filas FROM Cliente");
            return  $consulta->row()->filas;
    }
    
     function get_cliente($id)
    {
        $consulta = $this->db->query("SELECT * FROM Cliente WHERE idCliente='$id'");
        return $consulta->row();
    }
    
    public function Insert_Cliente($data)
    {
        $this->db->insert('Cliente', $data);
    }
   
        
    public function Update_Cliente($id, $data)
    {
        $this->db->where('idCliente', $id);
        $this->db->update('Cliente', $data);
    }
   
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
   
   
   
    
}

?>

