<?php

//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Rt
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre)
	{
		$sql="INSERT  into rt(Nombres)VALUES('$nombre')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idRt,$nombre )
	{
		$sql="UPDATE rt set Nombres='$nombre' WHERE idRT=$idRt";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	

	//Implementamos un método para activar categorías
	

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idRt)
	{
		$sql="SELECT * from rt where idRT='$idRt'";
		return ejecutarConsultaSimpleFila($sql);
	}
	public function eliminar($idRt){
		$sql="DELETE  FROM rt where idRT='$idRt'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM rt";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM rt ";
		return ejecutarConsulta($sql);		
	}
}





?>