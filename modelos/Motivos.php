<?php
require __DIR__."/../config/Conexion.php";

Class  Motivos
{
function __construct(){

}
public function insertar($nombre_area,$estado){
    $sql="INSERT INTO areas (nombre_area,estado)values
    ('$nombre_area','$estado')";
    return ejecutarConsulta($sql);
}
public function editar($idArea,$nombre_area){
    $sql="UPDATE areas set nombre_area='$nombre_area' where idArea='$idArea'";
    return ejecutarConsulta($sql);
}
public function listar_registros(){
	$sql="SELECT * FROM areas";
	return ejecutarConsulta($sql);
	
}

    public function mostrar_registros($idArea){
        $sql="SELECT * from areas WHERE idArea='$idArea'";
        return ejecutarConsultaSimpleFila($sql);
    }

}

?>