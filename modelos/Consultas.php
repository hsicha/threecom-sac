<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Consultas
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	public function comprasfecha($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT DATE(i.fecha_emision) as fecha,u.nombre as usuario, p.razon_social as proveedor,i.tipo_comprobante,i.serie_comprobante,i.num_comprobante,i.total_compra,i.impuesto,i.estado FROM ingreso i INNER JOIN clientes p ON i.idproveedor=p.idpersona INNER JOIN usuario u ON i.idusuario=u.idusuario WHERE DATE(i.fecha_hora)>='$fecha_inicio' AND DATE(i.fecha_hora)<='$fecha_fin'";
		return ejecutarConsulta($sql);		
	}
	// reporte de ventas
	public function reporte_general_ventas($idsede){
		$sql="CALL SP_CONSULTAR_VENTAS('$idsede')";
		return ejecutarConsulta($sql);
		
	}
	public function ventasfechacliente($fecha_inicio,$fecha_fin)
	{
		 $sql=" SELECT v.idventa, DATE(v.fecha_emision) AS fecha, p.razon_social AS cliente,tyd.nombre_tipo_doc,v.serie,v.numero,v.total_venta,v.estado 
FROM venta v INNER JOIN clientes p ON v.idcliente=p.idcliente INNER JOIN usuario u ON v.idusuario=u.idusuario
INNER JOIN  tipo_documento td 
ON td.idtipo_documento=v.idtipo_documento INNER JOIN type_doc tyd
ON tyd.idtipo_doc=td.idtipo_doc
 WHERE DATE(v.fecha_emision)>='$fecha_inicio' and DATE(v.fecha_emision)<='$fecha_fin'";
		return ejecutarConsulta($sql);		
	}

	public function totalcomprahoy()
	{
		$sql="SELECT IFNULL(SUM(total_compra),0) as total_compra FROM ingreso WHERE DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}

	public function totalventahoy()
	{
		$sql="SELECT IFNULL(SUM(total_venta),0) as total_venta FROM venta WHERE DATE(fecha_emision)=curdate()";
		return ejecutarConsulta($sql);
	}

	public function comprasultimos_10dias()
	{
		$sql="SELECT CONCAT(DAY(fecha_hora),'-',MONTH(fecha_hora)) as fecha,SUM(total_compra) as total FROM ingreso GROUP by fecha_hora ORDER BY fecha_hora DESC limit 0,10";
		return ejecutarConsulta($sql);
	}

	public function ventasultimos_12meses()
	{
		$sql="SELECT DATE_FORMAT(fecha_emision,'%M') as fecha,SUM(total_venta) as total FROM venta GROUP by MONTH(fecha_emision) ORDER BY fecha_emision DESC limit 0,10";
		return ejecutarConsulta($sql);
	}
	function total_del_dia(){
		$sql="SELECT forma_pago,SUM(total_venta)AS total FROM venta INNER JOIN forma_pagos
				ON venta.id_forma_pago=forma_pagos.id_forma_pago
				WHERE DATE(fecha_emision)>=DATE(NOW())
				GROUP BY forma_pago";
		return ejecutarConsulta($sql);

	}
	function obtener_ruc_serie_numeracion($idventa){
		$sql="CALL SP_CONSULTAR_VENTA('$idventa')";
		return ejecutarConsultaSimpleFila($sql);
	}
}

?>