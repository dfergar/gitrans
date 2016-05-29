<?php

class Conductores_model extends CI_Model{

   function __construct()
   {
       parent::__construct();
       $this->load->database();
   }
           
   function get_conductores($por_pagina,$segmento) 
   {
        $consulta = $this->db->query("SELECT * FROM Conductor LIMIT $segmento, $por_pagina");
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
   
   
   
   
}

?>

