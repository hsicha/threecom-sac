<?php 

require "../config/Conexion.php";

Class Perfil{
	
	public function __construct(){
		
	}
	public function insertar_perfil($descripcion){
		$sql="CALL SP_INSERTAR_PERFIL('$descripcion')";
		return ejecutarConsulta($sql);
	}
	public function editar_perfil($id_perfil,$desc_perfil){
		$sql="CALL SP_ACTUALIZAR_PERFIL('$id_perfil','$desc_perfil')";
		return ejecutarConsulta($sql);
	}
	public function listar_perfil(){
		$sql="CALL SP_LISTAR_PERFIL()";
		return ejecutarConsulta($sql);
	}
	public function mostrar_perfil($id_perfil){
		$sql="CALL SP_MOSTRAR_PERFIL('$id_perfil')";
		return ejecutarConsultaSimpleFila($sql);
	}
	public function eliminar_perfil($idperfil){
		$sql="CALL SP_ELIMINAR_PERFIL('$idperfil')";
		return ejecutarConsulta($sql);
	}
}



?>