<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Proveedor
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($cod_tipo_doc,$nro_documento,$razon_social,$direccion,$telefono,$estado_sunat)
	{
		$sql="INSERT INTO proveedor (cod_tipo_doc,nro_documento,razon_social,direccion,telefono,estado_sunat)
		VALUES ('$cod_tipo_doc','$nro_documento','$razon_social','$direccion','$telefono','$estado_sunat')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idproveedor,$cod_tipo_doc,$nro_documento,$razon_social,$direccion,$telefono)
	{
		$sql="UPDATE proveedor SET cod_tipo_doc='$cod_tipo_doc',nro_documento='$nro_documento',razon_social='$razon_social',direccion='$direccion',telefono='$telefono' WHERE idproveedor='$idproveedor'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idproveedor)
	{
		$sql="DELETE FROM proveedor WHERE idproveedor='$idproveedor'";
	
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idproveedor)
	{
		$sql="SELECT * FROM proveedor WHERE idproveedor='$idproveedor'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listarp()
	{
		$sql="SELECT proveedor.idproveedor, tipo_doc_contribuyente.descripcion_documento as tipo_doc,proveedor.nro_documento,proveedor.razon_social,proveedor.direccion,proveedor.telefono,proveedor.estado_sunat FROM `proveedor` inner join tipo_doc_contribuyente on proveedor.cod_tipo_doc=tipo_doc_contribuyente.cod_tipo_doc";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros 
	public function select()
	{
		$sql="SELECT * FROM tipo_doc_contribuyente ";
		return ejecutarConsulta($sql);		
	}
		function verificar_existencia($num_doc){
		$sql="select * from proveedor where  nro_documento='$num_doc'";
		return ejecutarConsulta($sql);
	}
	function obtener_proveedor($num_doc){
		$sql="select idproveedor from proveedor where nro_documento='$num_doc'";
		return ejecutarConsultaSimpleFila($sql);
	}
	
}

?>