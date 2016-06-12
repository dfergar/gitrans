<?php

class Conductores_model extends CI_Model{

   function __construct()
   {
       parent::__construct();
       $this->load->database();
   }
           
   /**
    * Consulta de conductores
    * @param type $por_pagina: elementos mostrados por página 
    * @param type $segmento: segmento usado por la paginación
    * @param type $orden: campo por el cual se ordenará la consulta
    * @return type: array con las filas de los conductores
    */
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
   
    /**
     * Inserción de un conductor
     * @param type $data: array con datos del condeuctor
     */
    public function Insert_Conductor($data)
    {
        $this->db->insert('Conductor', $data);
    }
   
    /**
     * Consulta de un conductor
     * @param type $id: id del conductor
     * @return type: array con los daytos del conductor
     */
    function get_conductor($id)
    {
        $consulta = $this->db->query("SELECT * FROM Conductor WHERE idConductor='$id'");
        return $consulta->row();
    }
    
    /**
     * Modificar conductor
     * @param type $id: id del conductor
     * @param type $data: array con los datos del conductor
     */
    public function Update_Conductor($id, $data)
    {
        $this->db->where('idConductor', $id);
        $this->db->update('Conductor', $data);
    }
   
}

?>

