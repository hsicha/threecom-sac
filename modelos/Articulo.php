<?php 
//Incluímos inicialmente la conexión a la base de datos
require __DIR__."/../config/Conexion.php";

Class Articulo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(
	$codigo_sunat,
	$codigo_producto,
	$nombre_producto,
	$idcategoria,
	$id_marca,
	$id_presentacion,
	$id_unidadMed,
	$stock,
	$pre_venta,
	$pre_costo,
	$ide_sede
	)
	{

		$sql = "CALL SP_INSERTAR_PRODUCTO('$codigo_sunat','$codigo_producto','$nombre_producto','$idcategoria','$id_marca','$id_presentacion','$id_unidadMed','$stock','$pre_venta','$pre_costo',	'$ide_sede')";
	//	echo $sql;
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idarticulo,
	$codigo_sunat,
	$codigo_producto,
	$nombre_producto,
	$idcategoria,
	$id_marca,
	$id_presentacion,
	$id_unidadMed,
	$stock,
	$imagen,
	$pre_venta,
	$pre_costo
	)
	{
		$sql="UPDATE articulo SET codigo_sunat='$codigo_sunat',
		codigo_producto='$codigo_producto',
		nombre_producto='$nombre_producto',
		 idcategoria='$idcategoria',
		 idmarca='$id_marca',
		 idpresentacion='$id_presentacion',
		 idunidad_medida='$id_unidadMed',
		 stock='$stock',
		 imagen='$imagen',
		 precio_base_venta='$pre_venta',
		 precio_costo='$pre_costo'
		 WHERE idarticulo='$idarticulo'";
		return ejecutarConsulta($sql);
	}
	// FIN DE LA FUNCION EDITAR

	//Implementamos un método para desactivar registros
	public function eliminar_producto($idarticulo)
	{
		$sql="CALL SP_ELIMINAR_PRODUCTO('$idarticulo')";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idarticulo)
	{
		$sql="UPDATE articulo SET condicion='1' WHERE idarticulo='$idarticulo'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idarticulo)
	{
		$sql="SELECT * FROM articulo WHERE idarticulo='$idarticulo'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar($id_sede)
	{
		$sql="CALL SP_LISTAR_PRODUCTOS('$id_sede')";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros activos
	public function listarActivos()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function listarActivosVenta()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo order by iddetalle_ingreso desc limit 0,1) as precio_venta,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);		
	}
	public function select()
	{
		$sql="SELECT * FROM unidad_medida";
		return ejecutarConsulta($sql);		
	}
	public	function listar_stock_minimo($codigo_almacen)
	{
		$sql="SELECT  a.idarticulo,UPPER(a.codigo_producto)AS codigo_producto,UPPER(a.nombre_producto)AS nombre_producto, m.nombre MARCA, c.nombre CATEGORIA, um.descr_unidad UM, a.precio_costo AS 'PRECIO_COSTO',a.precio_base_venta AS 'PRECIO_VENTA',a.stock AS stock,a.imagen AS imagen, a.condicion AS condicion
			FROM articulo a  INNER JOIN marca m ON a.idmarca=m.idMarca INNER JOIN categoria c ON a.idcategoria=c.idcategoria INNER JOIN unidad_medida um ON a.idunidad_medida=um.idunidad_medida
			WHERE codigo_almacen='$codigo_almacen' AND stock<=5 ORDER BY a.stock ASC";
		return ejecutarConsulta($sql);		
	}
}

?>