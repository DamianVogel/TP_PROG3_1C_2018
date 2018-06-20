<?php


class Detalle{

public $idDetalle;
public $idPedido;
public $producto;
public $tiempoPreparacion;
public $idEmpleado;
public $estado;
public $sector;





public function GuardarDetalle()
{
 
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into pedidodetalle (idPedido, producto, estado, sector)values(:idPedido, :producto, :estado, :sector)");
                $consulta->bindValue(':idPedido', $this->idPedido, PDO::PARAM_INT);
                $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
                $consulta->bindValue(':producto', $this->producto, PDO::PARAM_STR);
                $consulta->bindValue(':sector', $this->sector, PDO::PARAM_STR);
                
                $consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
}


public static function TraerTodosLosPedidos() 
{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from pedipedidodetalle");  
			$consulta->execute();
			$pedidos= $consulta->fetchAll(PDO::FETCH_CLASS, "Pedido");
            
            return $pedidos;
							
			
}

public static function TraerUnDetalle($idDetalle) 
{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from pedidodetalle WHERE idDetalle=:idDetalle");  
            $consulta->bindValue(':idDetalle', $idDetalle, PDO::PARAM_INT);
			$consulta->execute();
			$detalle= $consulta->fetchAll(PDO::FETCH_CLASS, "Detalle");
            
            return $detalle;
							
			
}

public static function TraerPendientes($idEmpleado)
{
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
    $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from pedidodetalle as pd where pd.sector in (select e.sector from empleados as e where e.id=$idEmpleado) and pd.estado=:estado or pd.idEmpleado= $idEmpleado");  
    $consulta->bindValue(':estado', "pendiente", PDO::PARAM_STR);
    //$consulta->bindValue(':id', $idEmpleado, PDO::PARAM_STR);
    $consulta->execute();
    $pedidos= $consulta->fetchAll(PDO::FETCH_CLASS, "Detalle");
    
    return $pedidos;
}

public function ModificarDetalle()
{
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("update pedidodetalle set idPedido=:idPedido, producto=:producto, tiempoPreparacion=:tiempoPreparacion, idEmpleado=:idEmpleado, estado=:estado, sector=:sector, tiempoEntrega= :tiempoEntrega WHERE idDetalle=:id");
        $consulta->bindValue(':idPedido',$this->idPedido, PDO::PARAM_INT);
        $consulta->bindValue(':producto',$this->producto, PDO::PARAM_STR);
        $consulta->bindValue(':tiempoPreparacion',$this->tiempoPreparacion, PDO::PARAM_STR);
        $consulta->bindValue(':idEmpleado',$this->idEmpleado, PDO::PARAM_INT);
        $consulta->bindValue(':estado',$this->estado, PDO::PARAM_STR);
        $consulta->bindValue(':sector',$this->sector, PDO::PARAM_STR);
        $consulta->bindValue(':tiempoEntrega',$this->tiempoEntrega, PDO::PARAM_STR);
        $consulta->bindValue(':id',$this->idDetalle, PDO::PARAM_INT);
       return $consulta->execute();

}

public function PrepararDetalle()
{
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("update pedidodetalle set tiempoPreparacion=:tiempoPreparacion, idEmpleado=:idEmpleado, estado=:estado WHERE idDetalle=:id");
        $consulta->bindValue(':tiempoPreparacion',$this->tiempoPreparacion, PDO::PARAM_STR);
        $consulta->bindValue(':idEmpleado',$this->idEmpleado, PDO::PARAM_INT);
        $consulta->bindValue(':estado',$this->estado, PDO::PARAM_STR);
        $consulta->bindValue(':id',$this->idDetalle, PDO::PARAM_INT);
       return $consulta->execute();

}







}

?>