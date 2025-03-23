<?php

//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Presentacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="INSERT INTO PRESENTACION(nombre,descripcion,estado)value( '$nombre','$descripcion','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idpresentacion,$nombre ,$descripcion)
	{
		$sql="UPDATE presentacion set nombre='$nombre' ,descripcion='$descripcion'where idpresentacion='$idpresentacion'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function eliminar_presentacion($idpresentacion)
	{
		$sql="DELETE FROM presentacion WHERE idpresentacion='$idpresentacion'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idpresentacion)
	{
		$sql="UPDATE presentacion SET estado='1' WHERE idpresentacion='$idpresentacion'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idpresentacion)
	{
		$sql="select * from presentacion where idpresentacion='$idpresentacion'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql=" 	select * from presentacion";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM presentacion ";
		return ejecutarConsulta($sql);		
	}
}
