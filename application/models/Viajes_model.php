<?php

class Viajes_model extends CI_Model{

   function __construct()
   {
       parent::__construct();
       $this->load->database();
   }
           
   function get_viajes($por_pagina,$segmento,$orden) 
   {
        $consulta = $this->db->query("SELECT * FROM Viaje ORDER BY $orden DESC LIMIT $segmento, $por_pagina");
        $data=array();
        foreach($consulta->result() as $fila)
        {
            $data[] = $fila;
        }
        return $data; 
   }
   
   function get_viaje($id) 
   {
        $consulta = $this->db->query("SELECT * FROM Viaje WHERE idViaje=$id");
        return $consulta->row();
   }
   
   function get_cargas($id)
   {
        $consulta = $this->db->query("SELECT * FROM Carga WHERE Viaje_id_carga=$id");
        return $consulta->result();
   }
   
   function get_descargas($id)
   {
        $consulta = $this->db->query("SELECT * FROM Descarga WHERE Viaje_id_descarga=$id");
        return $consulta->result();
   }
   
   function get_ncargas($id)
   {
       $consulta = $this->db->query("SELECT count(*) as filas FROM Carga WHERE Viaje_id_carga=$id");
       return  $consulta->row()->filas ;
   }
   
   function get_ndescargas($id)
   {
       $consulta = $this->db->query("SELECT count(*) as filas FROM Descarga WHERE Viaje_id_descarga=$id");
       return  $consulta->row()->filas ;
   }
   
   function delete_etapas_viaje($id)
   {
       $this->db->query("DELETE FROM Carga WHERE Viaje_id_carga=$id");
       $this->db->query("DELETE FROM Descarga WHERE Viaje_id_descarga=$id");
   }
   
   function get_vehiculos()
    {
        $consulta = $this->db->query("select idVehiculo, Matricula from Vehiculo");
        $vehiculos=array();
        foreach($consulta->result_array() as $fila)
        {
            $vehiculos[$fila['idVehiculo']]=$fila['Matricula'];
        }
        return $vehiculos;
    }
    
    function get_conductores()
    {
        $consulta = $this->db->query("select idConductor, Nombre, Apellidos from Conductor order by apellidos asc");
        $conductores=array();
        foreach($consulta->result_array() as $fila)
        {
            $conductores[$fila['idConductor']]=$fila['Nombre']." ".$fila['Apellidos'];
        }
        return $conductores;
    }
    
    function get_clientes()
    {
        $consulta = $this->db->query("select idCliente, Nombre from Cliente");
        $clientes=array();
        foreach($consulta->result_array() as $fila)
        {
            $clientes[$fila['idCliente']]=$fila['Nombre'];
        }
        return $clientes;
    }
    
    public function Insert_Viaje($data)
    {
        $this->db->insert('Viaje', $data);
    }
    
    public function Update_Viaje($id, $data)
    {
        $this->db->where('idViaje', $id);
        $this->db->update('Viaje', $data);
    }
    
    function Insert_Carga($data)
    {
        $this->db->insert('Carga', $data);
    } 
    
    function Insert_Descarga($data)
    {
        $this->db->insert('Descarga', $data);
    }
    
    public function Update_Carga($id, $data)
    {
        $this->db->where('idCarga', $id);
        $this->db->update('Carga', $data);
    }
    
    public function Update_Descarga($id, $data)
    {
        $this->db->where('idDescarga', $id);
        $this->db->update('Descarga', $data);
    }
    
    function Ultimo_Viaje()
    {
        $consulta = $this->db->query("select max(idViaje) as id from Viaje");
        return $consulta->row()->id;
    }
   
   function get_vehiculo($id)
    {
        $consulta = $this->db->query("SELECT * FROM Vehiculo WHERE idVehiculo='$id'");
        return $consulta->row();
    }
    
    
    
   
    
    function get_tipo($id)
    {
        $consulta = $this->db->query("SELECT * FROM Tipo WHERE idTipo='$id'");
        return $consulta->row()->Clase;
    }
    
    //obtenemos el total de filas para hacer la paginación
    function filas()
    {
            $consulta = $this->db->query("SELECT count(*) as filas FROM Viaje");
            return  $consulta->row()->filas ;
    }
   
   
   
   
    
}

?>

