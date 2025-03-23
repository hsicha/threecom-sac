<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Ingreso
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idproveedor,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$total_gravada,$total_igv,$total_compra,$idSede,$idarticulo,$cantidad,$precio_compra,$importe)
	{
		$sql="INSERT INTO ingreso (idproveedor,idusuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,total_gravada,total_igv,total_compra,estado,ID_SEDE)
		VALUES ('$idproveedor','$idusuario','$tipo_comprobante','$serie_comprobante','$num_comprobante','$fecha_hora','$total_gravada','$total_igv','$total_compra','Aceptado','$idSede')";
		//return ejecutarConsulta($sql);
		//echo $sql;
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idarticulo))
		{
			$sql_detalle = "INSERT INTO detalle_ingreso(idingreso, idarticulo,cantidad,precio_compra,precio_venta) VALUES ('$idingresonew', 
			'$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_compra[$num_elementos]','$importe[$num_elementos]')";
			$update_stk="UPDATE articulo set stock=stock+'$cantidad[$num_elementos]' where idarticulo='$idarticulo[$num_elementos]' and ID_SEDE='$idSede'";
			//echo $update_stk;
			ejecutarConsulta($sql_detalle) or $sw = false;
			ejecutarConsulta($update_stk);
			$num_elementos=$num_elementos + 1;
		
		}

		return $sw;
	}

	
	//Implementamos un método para anular categorías
	public function anular($idingreso)
	{
		$sql="UPDATE ingreso SET estado='Anulado' WHERE idingreso='$idingreso'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idingreso)
	{
		$sql="SELECT i.idingreso,DATE(i.fecha_hora) as fecha,i.idproveedor,p.nombre as proveedor,u.idusuario,u.nombre as usuario,i.tipo_comprobante,i.serie_comprobante,i.num_comprobante,i.total_compra,i.impuesto,i.estado FROM ingreso i INNER JOIN persona p ON i.idproveedor=p.idpersona INNER JOIN usuario u ON i.idusuario=u.idusuario WHERE i.idingreso='$idingreso'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idingreso)
	{
		$sql="SELECT di.idingreso,di.idarticulo,a.nombre_producto,di.cantidad,di.precio_compra,di.precio_venta FROM detalle_ingreso di inner join articulo a on di.idarticulo=a.idarticulo where di.idingreso='$idingreso'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar($idsede)
	{
		$sql="SELECT i.idingreso,DATE(i.fecha_hora) AS fecha,i.idproveedor,p.razon_social AS proveedor,
		u.idusuario,u.nombre AS usuario,i.tipo_comprobante,i.serie_comprobante,i.num_comprobante,p.nro_documento,
		i.total_compra,i.estado FROM ingreso i INNER JOIN proveedor p 
		ON i.idproveedor=p.idproveedor INNER JOIN usuario u 
		ON i.idusuario=u.idusuario WHERE ID_SEDE='$idsede' ORDER BY i.idingreso DESC";
		return ejecutarConsulta($sql);		
	}
	
	public function ingresocabecera($idingreso){
		$sql="SELECT i.idingreso,i.idproveedor,p.nombre as proveedor,p.direccion,p.tipo_documento,p.num_documento,p.email,p.telefono,i.idusuario,u.nombre as usuario,i.tipo_comprobante,i.serie_comprobante,i.num_comprobante,date(i.fecha_hora) as fecha,i.impuesto,i.total_compra FROM ingreso i INNER JOIN persona p ON i.idproveedor=p.idpersona INNER JOIN usuario u ON i.idusuario=u.idusuario WHERE i.idingreso='$idingreso'";
		return ejecutarConsulta($sql);
	}

	public function ingresodetalle($idingreso){
		$sql="SELECT a.nombre as articulo,a.codigo,d.cantidad,d.precio_compra,d.precio_venta,(d.cantidad*d.precio_compra) as subtotal FROM detalle_ingreso d INNER JOIN articulo a ON d.idarticulo=a.idarticulo WHERE d.idingreso='$idingreso'";
		return ejecutarConsulta($sql);
	}
	public function select(){
		$sql="select * from tipo_doc_contribuyente";
		return ejecutarConsulta($sql);
	}
	function autocomplet_Prov($nombre){
		$sql="select idproveedor,nro_documento,razon_social from  proveedor where nro_documento like '%$nombre%' or razon_social like '%$nombre%' ";
		return ejecutarConsulta($sql);
	}
	public function listar_productos($nombre,$idesde){
		$sql="select * from  articulo INNER JOIN sedes
		ON articulo.ID_SEDE=sedes.ID_SEDE where articulo.ID_SEDE='$idesde' and codigo_producto like '%$nombre%' and nombre_producto like '%$nombre%' ";
	
		return ejecutarConsulta($sql);
	}
		function obtener_proveedores($documento){
		$sql="select * from proveedor where nro_documento='$documento'";
		return ejecutarConsultaSimpleFila ($sql);

	}
	function obtener_stock($idproducto){
		$sql="select stock from articulo where idarticulo='$idproducto'";
		return ejecutarConsultaSimpleFila ($sql);
	
	}
	function actualizar_stock($idarticulo,$stock){
			$sql="select stock from articulo where idarticulo='$idarticulo'";
			$res=ejecutarConsulta($sql);
			
			$stk_actual=0;
			if($reg=mysqli_fetch_array($res)){
				$stk_actual=$reg[0];
			}
			$stk_actual+=$stock;
			
		$sql="update articulo set stock='$stock' where idarticulo='$idarticulo'";
			return ejecutarConsulta($sql);
	}
	public function cabecera_compra($idingreso){
		$sql="SELECT proveedor.razon_social,proveedor.nro_documento,proveedor.direccion,
		DATE_FORMAT(ingreso.fecha_hora,'%d/%m/%Y') AS fecha_hora ,
		ingreso.tipo_comprobante,ingreso.serie_comprobante,ingreso.num_comprobante,ingreso.total_gravada,ingreso.total_igv,ingreso.total_compra FROM  ingreso INNER JOIN proveedor
		ON ingreso.idproveedor=proveedor.idproveedor WHERE idingreso='$idingreso'";
	return ejecutarConsultaSimpleFila($sql);
	}
		public function detalle_compra($idingreso){
		$sql="SELECT detalle_ingreso.cantidad,CONCAT(articulo.codigo_producto,' - ',articulo.nombre_producto)
				AS producto,marca.nombre AS marca,articulo.precio_costo,(detalle_ingreso.cantidad*articulo.precio_costo) AS
				importe FROM detalle_ingreso INNER JOIN articulo
				ON detalle_ingreso.idarticulo=articulo.idarticulo INNER JOIN marca
				ON articulo.idmarca=marca.idMarca WHERE idingreso='$idingreso'";
	return ejecutarConsulta($sql);
	}

	



}

?>