<?php

class Vehiculos_model extends CI_Model{

   function __construct()
   {
       parent::__construct();
       $this->load->database();
   }
           
   /**
    * Consulta de vehículos
    * @param type $por_pagina: elementos por página
    * @param type $segmento: segmento de la url usado por la paginación
    * @param type $orden: campo por el cual se ordenará la consulta
    * @return type: datos de los vehículos
    */
   function get_vehiculos($por_pagina,$segmento, $orden) 
   {
        $consulta = $this->db->query("SELECT * FROM Vehiculo order by $orden asc LIMIT $segmento, $por_pagina");
        $data=array();
        foreach($consulta->result() as $fila)
        {
            $data[] = $fila;
        }
        return $data; 
   }
   
   /**
    * Consulta de vehículos por tipo
    * @param type $tipo: tipo de vehículo
    * @return type: array con los vehículos del tipo suministrado por parámetro
    */
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
    
   /**
    * Consulta de vehículo
    * @param type $id: id del vehículo
    * @return type: fila con los datyos del vehículo
    */
   function get_vehiculo($id)
    {
        $consulta = $this->db->query("SELECT * FROM Vehiculo WHERE idVehiculo='$id'");
        return $consulta->row();
    }
    
    /**
     * Consulta de tipod¡s de vehículo
     * @return type: array con los tipos de vehículo
     */
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
    
    /**
     * Consulta del tipo de vehículo
     * @param type $id: id del tipo de vehículo
     * @return type: fila con los datos del tipo de vehículo
     */
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
    
    /**
     * Inserción de vehículos
     * @param type $data: datos del vehículo
     */
    public function Insert_Vehiculo($data)
    {
        $this->db->insert('Vehiculo', $data);
    }
   
    /**
     * Modificación de vehículo
     * @param type $id: id del vehículo
     * @param type $data: datos del vehículo
     */    
    public function Update_Vehiculo($id, $data)
    {
        $this->db->where('idVehiculo', $id);
        $this->db->update('Vehiculo', $data);
    }
   
}

?>

