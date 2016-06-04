<?php

class Vehiculos_model extends CI_Model{

   function __construct()
   {
       parent::__construct();
       $this->load->database();
   }
           
   function get_vehiculos($por_pagina,$segmento) 
   {
        $consulta = $this->db->query("SELECT * FROM Vehiculo LIMIT $segmento, $por_pagina");
        $data=array();
        foreach($consulta->result() as $fila)
        {
            $data[] = $fila;
        }
        return $data; 
   }
   
   function get_vehiculos_tipo($tipo)
    {
        $consulta = $this->db->query("select idVehiculo, Matricula from Vehiculo where Tipo_id=$tipo");
        $vehiculos=array();
        foreach($consulta->result_array() as $fila)
        {
            $vehiculos[$fila['idVehiculo']]=$fila['Matricula'];
        }
        return $vehiculos;
    } 
    
   
   function get_vehiculo($id)
    {
        $consulta = $this->db->query("SELECT * FROM Vehiculo WHERE idVehiculo='$id'");
        return $consulta->row();
    }
    
    function get_tipos()
    {
        $consulta = $this->db->query("select idTipo, Clase from Tipo");
        $tipos=array();
        foreach($consulta->result_array() as $fila)
        {
            $tipos[$fila['idTipo']]=$fila['Clase'];
        }
        return $tipos;
    }
    
    
    function get_tipo($id)
    {
        $consulta = $this->db->query("SELECT * FROM Tipo WHERE idTipo=$id");
        return $consulta->row()->Clase;
    }
    
    
    //obtenemos el total de filas para hacer la paginación
    function filas()
    {
            $consulta = $this->db->query("SELECT count(*) as filas FROM Vehiculo");
            return  $consulta->row()->filas;
    }
    
    public function Insert_Vehiculo($data)
    {
        $this->db->insert('Vehiculo', $data);
    }
   
        
    public function Update_Vehiculo($id, $data)
    {
        $this->db->where('idVehiculo', $id);
        $this->db->update('Vehiculo', $data);
    }
   
}

?>

