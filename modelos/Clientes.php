<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Cliente
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($cod_tipo_doc,$nro_documento,$razon_social,$direccion,$telefono,$estado_sunat)
	{
		$sql="INSERT INTO clientes (cod_tipo_doc,num_documento,razon_social,direccion,telefono,estado_sunat)
		VALUES ('$cod_tipo_doc','$nro_documento','$razon_social','$direccion','$telefono','$estado_sunat')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idcliente,$cod_tipo_doc,$nro_documento,$razon_social,$direccion,$telefono)
	{
		$sql="UPDATE clientes SET cod_tipo_doc='$cod_tipo_doc',num_documento='$nro_documento',razon_social='$razon_social',direccion='$direccion',telefono='$telefono' WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idcliente)
	{
		$sql="DELETE FROM clientes WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcliente)
	{
		$sql="SELECT * FROM clientes WHERE idcliente='$idcliente'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listarc()
	{
		$sql="SELECT clientes.idcliente, tipo_doc_contribuyente.descripcion_documento as tipo_doc,clientes.num_documento,clientes.razon_social,clientes.direccion,clientes.telefono,clientes.estado_sunat 
		FROM `clientes` inner join tipo_doc_contribuyente on clientes.cod_tipo_doc=tipo_doc_contribuyente.cod_tipo_doc";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros 
	public function select()
	{
		$sql="SELECT * FROM tipo_doc_contribuyente ";
		return ejecutarConsulta($sql);		
	}
	function verificar_existencia($num_doc){
		$sql="select * from clientes where  num_documento='$num_doc'";
		return ejecutarConsulta($sql);
	}
	function obtener_idcliente($num_doc){
		$sql="select idcliente from clientes where num_documento='$num_doc'";
		return ejecutarConsultaSimpleFila($sql);
	}
}

?>