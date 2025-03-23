<?php

require '../config/Conexion.php';

class Nota_Credito{
	
	function __construct(){
		
	}
		public function insertar(
		$idcliente,
		$id_tipo_doc,
		$id_operacion,
		$serie,
		$numero,
		$fecha_emision,
		$fecha_vencimiento,
		$hora_emision,
		$id_forma_pago,
		$id_moneda,
		$total_gravada,
		$total_igv,
		$total_gratuita,
		$total_exonerada,
		$total_inafecta,
		$total_exportacion,
		$total_bolsa,
		$total_venta,
		$nota,
		$estado,
		$idusuario,
		$obs,
		$nro_ope,
		$id_modo_pago,
		$porcentaje_igv,
		$relacionado_motivo_codigo,
		$serie_nota,
		$numero_nota,
		$estado_operacion,
		$respuesta_sunat,
		$idarticulo,
		$cantidad,
		$id_tipo_igv,
		$precio_venta,
		$total
		)
	{
		$sql="INSERT INTO venta (idventa,
		idcliente,
		idtipo_documento,
		id_operacion,
		serie,
		numero,
		fecha_emision,
		fecha_vemcimiento,
		hora_emision,
		id_forma_pago,
		id_moneda,
		total_gravada,
		total_igv,
		total_gratuita,
		total_exonerada,
		total_inafecta,
		total_exportacion,
		total_bolsa,
		total_venta,
		nota,
		estado,
		idusuario,
		observaciones,
		nro_operacion,
		id_modo_pago,
		porcentaje_igv,
		relacionado_motivo_codigo,
		serie_nota,
		numero_nota,
		estado_operacion,
		respuesta_sunat
		)
		VALUES (0,'$idcliente',
		'$id_tipo_doc',
		'$id_operacion',
		'$serie',
		'$numero',
		'$fecha_emision',
		'$fecha_vencimiento',
		'$hora_emision',
		'$id_forma_pago',
		'$id_moneda',
		'$total_gravada',
		'$total_igv',
		'$total_gratuita',
		'$total_exonerada',
		'$total_inafecta',
		'$total_exportacion',
		'$total_bolsa',
		'$total_venta',
		'$nota',
		'$estado',
		'$idusuario',
		'$obs',
		'$nro_ope',
		'$id_modo_pago',
		'$porcentaje_igv',
		'$relacionado_motivo_codigo',
		'$serie_nota',
		'$numero_nota',
		'$estado_operacion',
		'$respuesta_sunat'
		)";
		//return ejecutarConsulta($sql);
		$idventanew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idarticulo))
		{
			$sql_detalle = "INSERT INTO detalle_venta(idventa, idarticulo,cantidad,id_tipo_igv,precio_venta,total) VALUES ('$idventanew', '$idarticulo[$num_elementos]','$cantidad[$num_elementos]','1', ($precio_venta[$num_elementos]/1.18), ($total[$num_elementos]/1.18))";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}
	function listar_tipo_nota_credito(){
		$sql="select  * from  tipo_ncredito";
		return ejecutarConsulta($sql);
	}
	public function listar_documento(){
		$sql="SELECT numero,concat(serie,'-',numero) as documento from venta";
		return ejecutarConsulta($sql);
	}
		function llenar_comdo_documento($idusuario){
		$sql="select td.idtipo_documento as id_Tipodoc, ty.nombre_tipo_doc as comprobante from tipo_documento td inner join type_doc ty on td.idtipo_doc=ty.idtipo_doc
			where ty.idtipo_doc in(1,3)and td.idusuario='$idusuario'";
			return ejecutarConsulta($sql);

	}
	function llenar_combo_Nota($idusuario){
		$sql="select td.idtipo_documento as id_Tipodoc, ty.nombre_tipo_doc as comprobante from tipo_documento td inner join type_doc ty on td.idtipo_doc=ty.idtipo_doc
			where ty.idtipo_doc in(7)and td.idusuario='$idusuario'";
			return ejecutarConsulta($sql);

	}
	public function obtener_venta_cabecera($serie, $numero){
		$sql="SELECT venta.serie,venta.numero , type_doc.idtipo_doc,type_doc.nombre_tipo_doc, venta.fecha_emision fecha_emision_sf,
			DATE_FORMAT(venta.fecha_emision,'%d-%m-%Y') AS fecha_emision,
			DATE_FORMAT( venta.fecha_vemcimiento,'%d-%m-%Y')AS fecha_vencimiento,venta.fecha_vemcimiento fecha_vencimiento_sf,
		 	venta.hora_emision,tipo_doc_contribuyente.cod_tipo_doc,clientes.idcliente,clientes.num_documento, clientes.razon_social,
			clientes.direccion,forma_pagos.id_forma_pago,forma_pagos.forma_pago,monedas.moneda,monedas.abrstandar,monedas.id_moneda,venta.total_igv,
			venta.total_exonerada,venta.total_gratuita,venta.total_inafecta,venta.total_venta,venta.total_gravada,venta.total_exportacion,venta.total_bolsa,
			usuario.nombre,tipo_operaciones.codigo,type_doc.codigo_documento,venta.porcentaje_igv,venta.nota
			FROM venta INNER JOIN tipo_documento
			ON venta.idtipo_documento=tipo_documento.idtipo_documento INNER JOIN type_doc
			ON tipo_documento.idtipo_doc=type_doc.idtipo_doc INNER JOIN clientes
			ON venta.idcliente=clientes.idcliente INNER JOIN tipo_doc_contribuyente
			ON clientes.cod_tipo_doc=tipo_doc_contribuyente.cod_tipo_doc INNER JOIN forma_pagos
			ON venta.id_forma_pago=forma_pagos.id_forma_pago INNER JOIN monedas
			ON venta.id_moneda=monedas.id_moneda INNER JOIN usuario
			ON venta.idusuario=usuario.idusuario  INNER JOIN tipo_operaciones
			ON venta.id_operacion=tipo_operaciones.id_operacion
			WHERE venta.serie = '$serie' and numero LIKE '%$numero%'";
		  return ejecutarConsulta($sql); 
	}
	public function obtener_detalle_venta($serie,$numero){
		$sql="SELECT articulo.idarticulo,articulo.nombre_producto,
		detalle_venta.cantidad,ROUND(detalle_venta.precio_venta*(1.18),2) AS precio_venta,
		ROUND(detalle_venta.total*(1.18),2) AS total FROM detalle_venta INNER JOIN venta
		ON detalle_venta.idventa=venta.idventa INNER JOIN articulo
		ON detalle_venta.idarticulo=articulo.idarticulo WHERE venta.serie = '$serie' and numero LIKE '%$numero%'";
	return ejecutarConsulta($sql); 
}
}

?>