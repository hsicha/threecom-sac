<?php
require "../config/Conexion.php";
class Consultas_Xml{

    function __construct(){

    }
    function obtener_empresa(){
        $sql="select * from empresas";
        return ejecutarConsulta($sql);
    }
    function obtener_sede($idsede){
        $sql="SELECT ubigeo.codigo_ubigeo,ubigeo.departamento,ubigeo.provincia,ubigeo.distrito FROM sedes INNER JOIN ubigeo
        ON sedes.id_ubigeo=ubigeo.id_ubigeo WHERE sedes.ID_SEDE='$idsede'";
        return ejecutarConsulta($sql);
    }
  function obtener_id_venta(){
		$sql="SELECT MAX(idventa) AS id FROM  venta";
		return ejecutarConsultaSimpleFila($sql);
	}
    function obtener_venta($idventa){
        $sql="call SP_CREAR_XML('$idventa')";
        return ejecutarConsulta($sql);
    }
    function obtener_detalle($idventa){
        $sql="SELECT * FROM detalle_venta where idventa='$idventa'";
        return ejecutarConsulta($sql);

    }
    


}



?>