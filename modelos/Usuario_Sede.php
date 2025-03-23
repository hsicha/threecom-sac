<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Usuario_Sede
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	
	}
	public function insertar_usuario_sede($idusuario,$id_sede){
	 $sql="CALL SP_INSERTAR_USUARIO_SEDE('$idusuario','$id_sede')";
	 return ejecutarConsulta($sql);	
		
	}
	public function actualizar_usuario_sede($id_usuario_sede,$idusuario,$id_sede){
		$sql="CALL SP_ACTUALIZAR_USUARIO_SEDE('$id_usuario_sede','$idusuario','$id_sede')";
	
		return ejecutarConsulta($sql);
	}
	
	public function listar_usuario_combo(){
	$sql="CALL SP_LISTAR_USUARIOS()";
	return ejecutarConsulta($sql);
		
	}
	public function listar_sede_combo(){
	$sql="CALL SP_LISTAR_COMBO_SUCURSAL()";
	echo $sql;
	return ejecutarConsulta($sql);
		
	}
	public function mostrar($id_usuario_sede){
	  $sql="CALL SP_MOSTRAR_USUARIO_SEDE('$id_usuario_sede')";
	  return ejecutarConsultaSimpleFila($sql);
	}
	public function eliminar_sede_usr($id_usuario_sede){
	 $sql ="CALL SP_ELIMINAR_USUARIO_SEDE('$id_usuario_sede')";
	 return ejecutarConsulta($sql);
	}
	//Implementar un método para listar los registros
	public function listar_usuario_sede()
	{
		$sql="CALL SP_LISTAR_USUARIO_SEDE()";
		//echo $sql;
		return ejecutarConsulta($sql);		
	}
	public function listar()
	{
		$sql="SELECT * FROM permiso";
		return ejecutarConsulta($sql);		
	}

	

}

?>