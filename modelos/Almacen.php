<?php
require '../config/Conexion.php';
class Almacen{
    // metodo para registrar nuevo almacen
    public function __construct(){

    }
    public function insertar($nombre,$descripcion){
        $sql="INSERT INTO almacen(nombre,descripcion,estado)values('$nombre','$descripcion',1)";
        return ejecutarConsulta($sql);
    }
    public function actualizar($codigo,$nombre,$descripcion){
        $sql="UPDATE almacen set nombre='$nombre',descripcion='$descripcion'where codigo_almacen='$codigo'";
        return ejecutarConsulta($sql);
    }
   public function listar(){
    $sql="SELECT * FROM almacen";
    return ejecutarConsulta($sql);
   }
   public function mostrar_detalle($codigo_almacen){
    $sql="select * from almacen where codigo_almacen='$codigo_almacen'";
    return ejecutarConsultaSimpleFila($sql);
   }
   function Select_sedes(){
    $sql="select * from sedes";
    return ejecutarConsulta($sql);
   }

    function activar($idalmacen){
        $sql="UPDATE almacen SET estado=1 WHERE CODIGO_ALMACEN='$idalmacen' ";
        return ejecutarConsulta($sql);
    }
    function desactivar($idalmacen){
        $sql="UPDATE almacen SET estado=0 WHERE CODIGO_ALMACEN=$idalmacen";
        return ejecutarConsulta($sql);
    }


}
?>