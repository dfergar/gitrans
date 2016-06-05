<?php

class Viajes_model extends CI_Model{

   function __construct()
   {
       parent::__construct();
       $this->load->database();
   }
           
   function get_viajes($por_pagina,$segmento) 
   {
        $consulta = $this->db->query("SELECT * FROM Viaje LIMIT $segmento, $por_pagina");
        $data=array();
        foreach($consulta->result() as $fila)
        {
            $data[] = $fila;
        }
        return $data; 
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
    
    function Insert_Carga($data)
    {
        $this->db->insert('Carga', $data);
    } 
    
    function Insert_Descarga($data)
    {
        $this->db->insert('Descarga', $data);
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
   
   
   
   
   /*
   function get_destacados($por_pagina,$segmento) 
    {
        $consulta = $this->db->query("SELECT * FROM Producto WHERE Destacado=1 LIMIT $segmento, $por_pagina");
        $data=array();
        foreach($consulta->result() as $fila)
        {
            $data[] = $fila;
        }
        return $data;
    }
      
    function get_prod_id($id)
    {
        $consulta = $this->db->query("SELECT * FROM Producto WHERE idProducto='$id'");
        return $consulta->row();
                
        
    }
    
    function get_prod_categoria($prod_categoria, $por_pagina,$segmento)
    {
        $producto = $this->db->query("SELECT * FROM Producto WHERE Categoria='$prod_categoria' LIMIT $segmento, $por_pagina");
        return $producto->result();
    }
    
    function get_categorias()
    {
        $categoria = $this->db->query("SELECT * FROM Categoria");
        return $categoria->result();
    }
    
    	
    //obtenemos el total de filas para hacer la paginación
    function filas()
    {
            $consulta = $this->db->query("SELECT * FROM Viaje");
            return  $consulta->num_rows() ;
    }

    //obtenemos el total de filas para hacer la paginación
    function filas_categoria($categoria)
    {
            $consulta = $this->db->query("SELECT * FROM Producto WHERE Categoria=$categoria");
            return  $consulta->num_rows() ;
    }*/
     
    /**
     * Comprobar si hay disponibilidad de las unidades del producto solicitado
     * @param type $id:     id del producto
     * @param type $und:    unidades solicitadas
     * @return boolean
     */
    /*
    function check_stock($id)
    {
        $consulta = $this->db->query("SELECT * FROM Producto WHERE idProducto=$id");
        return $consulta->row()->Stock;
        
    }
    
    function AddPedido($data)
    {
        $this->db->insert('Pedido', $data);       
    }
    
    function UltimoPedido()
    {
        $consulta=$this->db->query("SELECT MAX(idPedido) as id FROM Pedido");
        return $consulta->row()->id;
    }
    
    function AddLinea($data)
    {
        $this->db->insert('LineaPedido', $data);
    }
    
    function GetLineas($idPedido)
    {
        $consulta=$this->db->query("SELECT * FROM LineaPedido WHERE Pedido_idPedido=$idPedido");
    return $consulta->result();
    }
    
    function GetPedido($idPedido)
    {
        $consulta=$this->db->query("SELECT * FROM Pedido WHERE idPedido=$idPedido");
        return $consulta->row();
    }
    
    
    public function estado_pedido($n)
    {
        switch($n)
        {
            case 1: return "Pendiente de envío";
                break;
            case 2: return "Enviado";
                break;
            case 3: return "Entregado";
                break;
        }

    }
    
    public function DeletePedido($idPedido)
    {
        $this->db->delete('LineaPedido', array('Pedido_idPedido'=>$idPedido));
        $this->db->delete('Pedido', array('idPedido' => $idPedido));
        
    }
    
    public function SetProducto($id,$data)
    {
        $this->db->where('idProducto', $id);
        $this->db->update('Producto', $data);
        
    } 
    
    public function Productos_Agregador($por_pagina,$segmento)
    {
        $resultados=$this->get_destacados($por_pagina, $segmento);
        $dest=array();
        foreach($resultados as $resultado)
        {
            $dest[]=array(
                'nombre'=>$resultado->Nombre, 
                'descripcion'=>$resultado->Descripcion,
                'precio'=>$resultado->PrecioVenta,
                'img'=>base_url().$resultado->Imagen,
                'url'=>site_url('compras/agregar/'.$resultado->idProducto)
            );
        }
        return $dest;
                
    }
    */
    
}

?>

