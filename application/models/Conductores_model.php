<?php

class Conductores_model extends CI_Model{

   function __construct()
   {
       parent::__construct();
       $this->load->database();
   }
           
   function get_conductores($por_pagina,$segmento, $orden) 
   {
        $consulta = $this->db->query("SELECT * FROM Conductor order by $orden asc LIMIT $segmento, $por_pagina");
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
            $consulta = $this->db->query("SELECT count(*) as filas FROM Conductor");
            return  $consulta->row()->filas;
    }
   
    public function Insert_Conductor($data)
    {
        $this->db->insert('Conductor', $data);
    }
   
    function get_conductor($id)
    {
        $consulta = $this->db->query("SELECT * FROM Conductor WHERE idConductor='$id'");
        return $consulta->row();
    }
    
    public function Update_Conductor($id, $data)
    {
        $this->db->where('idConductor', $id);
        $this->db->update('Conductor', $data);
    }
   
}

?>

