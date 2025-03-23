<?php

require "../config/Conexion.php";

class Sedes{
    public function __construct(){

    }
    function insertar($direccion,$id_ubigeo,$ubigeo,$nombre_sede,$tel_celular,$anexo){
        $sql="CALL SP_INSERTAR_SEDES('$direccion','$id_ubigeo','$ubigeo','$nombre_sede','$tel_celular','$anexo')";
        
        return ejecutarConsulta($sql);


    }
    function editar($idsede,$direccion,$id_ubigeo,$ubigeo,$nombre_sede,$tel_celular,$anexo){
        $sql="CALL SP_ACTUALIZAR_SEDES('$idsede','$direccion','$id_ubigeo','$ubigeo','$nombre_sede','$tel_celular','$anexo')";
        return  ejecutarConsulta($sql);
    }
    function select_usuario(){
        $sql="SELECT * from usuario where  condicion=1";
        return ejecutarConsulta($sql);
    }
    function select_almacen(){
        $sql="SELECT * FROM almacen WHERE ESTADO=1";
      return  ejecutarConsulta($sql);
    }
    function mostrar($idsede){
        $sql="SELECT *FROM sedes where id_sede='$idsede'";
        
        return ejecutarConsultaSimpleFila($sql);
    }
    function listar(){
        $sql="CALL SP_LISTAR_SEDE()";
        return ejecutarConsulta($sql);
    }
    function listar_ubigeo(){
        $sql="SELECT id_ubigeo, CONCAT(upper(distrito),' - ',upper(provincia),' - ',upper(departamento)) as local FROM ubigeo";
        return ejecutarConsulta($sql);
    }
    function obtener_ubigeo($id_ubigeo){
        $sql="SELECT * from ubigeo WHERE id_ubigeo='$id_ubigeo' ";
        return ejecutarConsultaSimpleFila($sql);

    }
    function eliminar_sede($idsede){
    	$sql="CALL SP_ELIMINAR_SEDE('$idsede')";
    
    	return ejecutarConsulta($sql);
    	
    }
   
}
?>