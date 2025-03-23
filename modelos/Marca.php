<?php

//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Marca
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre)
	{
		$sql="CALL SP_INSERTAR_MARCA('$nombre')";
		echo $sql;
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idmarca,$nombre )
	{
		$sql="CALL SP_ACTUALIZAR_MARCA('$idmarca','$nombre')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function eliminar_marca($idmarca)
	{
		$sql="CALL SP_ELIMINAR_MARCA('$idmarca')";
	
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idmarca)
	{
		$sql="UPDATE marca SET estado='1' WHERE idmarca='$idmarca'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idmarca)
	{
		$sql="SELECT * from marca where idmarca='$idmarca'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="CALL SP_LISTAR_MARCA()";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM marca where estado=1";
		return ejecutarConsulta($sql);		
	}
}





?>