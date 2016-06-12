<?php

class Viajes_model extends CI_Model{

   function __construct()
   {
       parent::__construct();
       $this->load->database();
   }
           
   /**
    * Consulta de viajes
    * @param type $por_pagina: elementos por página
    * @param type $segmento: segmento de la url usado por la paginación
    * @param type $orden: campo por el cual se ordenará la consulta
    * @return type: datos con los viajes
    */
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
   
   /**
    * Consulta de un viaje
    * @param type $id: id del viaje
    * @return type: fila con los datos del viaje
    */
   function get_viaje($id) 
   {
        $consulta = $this->db->query("SELECT * FROM Viaje WHERE idViaje=$id");
        return $consulta->row();
   }
   
   /**
    * Consulta de las cargas de un viaje
    * @param type $id: id del viaje
    * @return type: cargas del viaje
    */
   function get_cargas($id)
   {
        $consulta = $this->db->query("SELECT * FROM Carga WHERE Viaje_id_carga=$id");
        return $consulta->result();
   }
   
   /**
    * Consulta de las descargas de un viaje
    * @param type $id: id del viaje
    * @return type: descargas del viaje
    */
   function get_descargas($id)
   {
        $consulta = $this->db->query("SELECT * FROM Descarga WHERE Viaje_id_descarga=$id");
        return $consulta->result();
   }
   
   /**
    * Consulta del número de cargas de un viaje
    * @param type number $id: id del viaje
    * @return type number: número de cargas
    */
   function get_ncargas($id)
   {
       $consulta = $this->db->query("SELECT count(*) as filas FROM Carga WHERE Viaje_id_carga=$id");
       return  $consulta->row()->filas ;
   }
   
   /**
    * Consulta del número de descargas de un viaje
    * @param type number $id: id del viaje
    * @return type number: número de descargas
    */
   function get_ndescargas($id)
   {
       $consulta = $this->db->query("SELECT count(*) as filas FROM Descarga WHERE Viaje_id_descarga=$id");
       return  $consulta->row()->filas ;
   }
   
   /**
    * Borrado de cargas y descargas de un viaje
    * @param type number $id: id del viaje
    */
   function delete_etapas_viaje($id)
   {
       $this->db->query("DELETE FROM Carga WHERE Viaje_id_carga=$id");
       $this->db->query("DELETE FROM Descarga WHERE Viaje_id_descarga=$id");
   }
   
   /**
    * Consulta de vehículos
    * @return type: array con los vehículos
    */
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
    
    /**
     * Consulta de conductores
     * @return array con los conductores
     */
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
    
    /**
     * Consulta de clientes
     * @return type array de clientes
     */
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
    
    /**
     * Inserción de viajes
     * @param type $data: array con los datos del viaje
     */
    public function Insert_Viaje($data)
    {
        $this->db->insert('Viaje', $data);
    }
    
    /**
     * Modificar datos de un viaje
     * @param type number $id: id del vuaje
     * @param type array $data: datos del viaje
     */
    public function Update_Viaje($id, $data)
    {
        $this->db->where('idViaje', $id);
        $this->db->update('Viaje', $data);
    }
    
    /**
     * Inserción de cargas
     * @param type array $data: datos de la carga
     */
    function Insert_Carga($data)
    {
        $this->db->insert('Carga', $data);
    } 
    
     /**
     * Inserción de descargas
     * @param type array $data: datos de la descarga
     */
    function Insert_Descarga($data)
    {
        $this->db->insert('Descarga', $data);
    }
    
    /**
     * Modificar carga
     * @param type number $id: id de la carga
     * @param type array $data: datos de la carga
     */
    public function Update_Carga($id, $data)
    {
        $this->db->where('idCarga', $id);
        $this->db->update('Carga', $data);
    }
    /**
     * Modificar descarga
     * @param type number $id: id de la descarga
     * @param type array $data: datos de la descarga
     */    
    public function Update_Descarga($id, $data)
    {
        $this->db->where('idDescarga', $id);
        $this->db->update('Descarga', $data);
    }
    
    /**
     * Consulta del id del último viaje introducido
     * @return type number: id del ultimo viaje introducido
     */
    function Ultimo_Viaje()
    {
        $consulta = $this->db->query("select max(idViaje) as id from Viaje");
        return $consulta->row()->id;
    }
   
   /**
    * Consulta de un vehículo
    * @param type number $id: id del vehículo
    * @return type object: fila con los datos del vehículo
    */
    function get_vehiculo($id)
    {
        $consulta = $this->db->query("SELECT * FROM Vehiculo WHERE idVehiculo='$id'");
        return $consulta->row();
    }
    
   
    /**
     * Consulta de un tipo de vehículo
     * @param type number $id: id del tipo de vehículo
     * @return type object: fila con los datos del tipo de vehículo
     */
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

