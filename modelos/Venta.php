<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Venta
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
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
		$id_sede,
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
		respuesta_sunat,
		id_sede
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
		'$respuesta_sunat',
		'$id_sede'
		)";
		//return ejecutarConsulta($sql);
		$idventanew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idarticulo))
		{
		$sql_detalle = "INSERT INTO detalle_venta(idventa, idarticulo,cantidad,id_tipo_igv,precio_venta,total) VALUES ('$idventanew', '$idarticulo[$num_elementos]','$cantidad[$num_elementos]','1', ($precio_venta[$num_elementos]/1.18), ($total[$num_elementos]/1.18))";
		$update_stk="UPDATE articulo set stock=stock-'$cantidad[$num_elementos]' where idarticulo='$idarticulo[$num_elementos]' and ID_SEDE='$id_sede'";
		echo $update_stk;
			ejecutarConsulta($sql_detalle) or $sw = false;
			ejecutarConsulta($update_stk);
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	
	//Implementamos un método para anular la venta
	public function cambiar_estado($idventa,$estado_venta,$estado_ope,$respuesta_sunat){
		$sql="CALL SP_ACTUALZAR_ESTADO_VENTA('$idventa','$estado_venta','$estado_ope','$respuesta_sunat')";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idventa)	{
		$sql="SELECT idventa from venta WHERE idventa='$idventa'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarDetalle($idventa){
		$sql="SELECT dv.idventa,dv.idarticulo,a.nombre,dv.cantidad,dv.precio_venta,dv.descuento,(dv.cantidad*dv.precio_venta-dv.descuento) as subtotal FROM detalle_venta dv inner join articulo a on dv.idarticulo=a.idarticulo where dv.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
public function listar($id_sede){
	$sql="CALL SP_LISTAR_VENTA_DIA('$id_sede')";
	return ejecutarConsulta($sql);		
}



	public function ventadetalle($idventa){
		$sql="SELECT a.nombre as articulo,a.codigo,d.cantidad,d.precio_venta,d.descuento,(d.cantidad*d.precio_venta-d.descuento) as subtotal FROM detalle_venta d INNER JOIN articulo a ON d.idarticulo=a.idarticulo WHERE d.idventa='$idventa'";
		return ejecutarConsulta($sql);
	}
	// funciones de adicionales para la extracciin de datos
	function autocomplet_Cliente($nombre){
		$sql="select * from  clientes where num_documento like '%$nombre%' or razon_social like '%$nombre%' ";
		return ejecutarConsulta($sql);
	}
	function autocomplete_producto($nombre,$idsede){
		$sql="select * from  articulo where  nombre_producto like '%$nombre%' AND ID_SEDE='$idsede'";
	
		return ejecutarConsulta($sql);
	}
	function obtener_clientes($documento){
		$sql="select * from clientes where num_documento='$documento'";
		return ejecutarConsultaSimpleFila ($sql);

	}
	function llenar_comdo_documento($idsede){
		$sql="CALL SP_LLENAR_COMBO_DOCUMENTO('$idsede')";
			return ejecutarConsulta($sql);

	}
	function obtener_serie_doc_documento($idtipodoc,$idsede){
		$sql="CALL SP_OBTENER_SERIE_NUM('$idtipodoc','$idsede')";
		
		return ejecutarConsultaSimpleFila($sql);
	}
	
	function obtener_generar_correlativo_venta($serie){
		$sql="CALL SP_GENARAR_CORRELATIVO_VENTA('$serie')";
		
		return ejecutarConsultaSimpleFila($sql);
	}
	function llenar_comdo_tipoOp(){
		$sql="SELECT * FROM tipo_operaciones";
		return ejecutarConsulta($sql);
	}
	function forma_pago(){
		$sql="SELECT * FROM modo_pago";
		return ejecutarConsulta($sql);
	}
	function obtener_2($idtipo_doc,$idusuario){
		$sql="SELECT COUNT(*) AS numero, tipo_documento.num_serie FROM venta
		INNER JOIN tipo_documento ON
		venta.idtipo_documento=tipo_documento.idtipo_documento
		 WHERE venta.idtipo_documento='$idtipo_doc' and  venta.idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}
	
	function llenar_combo_moneda(){
		$sql="SELECT * FROM monedas";
		return ejecutarConsulta($sql);
	}
	function llenar_combo_igv(){
		$sql="SELECT * FROM tipo_igvs";
		return ejecutarConsulta($sql);
	}
	function obtener_empresa(){
        $sql="select * from empresas";
        return ejecutarConsultaSimpleFila($sql);
    }
    function obtener_sede($idsede){
        $sql="SELECT ubigeo.codigo_ubigeo,ubigeo.departamento,ubigeo.provincia,ubigeo.distrito,
		sedes.direccion, sedes.urbanizacion FROM sedes INNER JOIN ubigeo
        ON sedes.id_ubigeo=ubigeo.id_ubigeo WHERE sedes.ID_SEDE='$idsede'";
        return ejecutarConsultaSimpleFila($sql);
    }
  function obtener_id_venta(){
		$sql="SELECT MAX(idventa) AS id FROM  venta";
		return ejecutarConsultaSimpleFila($sql);
	}
    function obtener_venta($idventa){
        $sql="SELECT venta.serie,venta.numero , type_doc.idtipo_doc,type_doc.nombre_tipo_doc, venta.fecha_emision fecha_emision_sf,
			DATE_FORMAT(venta.fecha_emision,'%d/%m/%Y') as fecha_emision,
			DATE_FORMAT( venta.fecha_vemcimiento,'%d/%m/%Y')as fecha_vencimiento,venta.fecha_vemcimiento fecha_vencimiento_sf,
		 	venta.hora_emision,tipo_doc_contribuyente.cod_tipo_doc,clientes.num_documento, clientes.razon_social,
			clientes.direccion,forma_pagos.id_forma_pago,forma_pagos.forma_pago,monedas.moneda,monedas.abrstandar,monedas.id_moneda,venta.total_igv,
			venta.total_exonerada,venta.total_gratuita,venta.total_inafecta,venta.total_venta,venta.total_gravada,venta.total_exportacion,venta.total_bolsa,
			usuario.nombre,tipo_operaciones.codigo,type_doc.codigo_documento,venta.porcentaje_igv,venta.nota,venta.estado
			FROM venta INNER JOIN tipo_documento
			ON venta.idtipo_documento=tipo_documento.idtipo_documento INNER JOIN type_doc
			ON tipo_documento.idtipo_doc=type_doc.idtipo_doc INNER JOIN clientes
			ON venta.idcliente=clientes.idcliente INNER JOIN tipo_doc_contribuyente
			ON clientes.cod_tipo_doc=tipo_doc_contribuyente.cod_tipo_doc INNER JOIN forma_pagos
			ON venta.id_forma_pago=forma_pagos.id_forma_pago INNER JOIN monedas
			ON venta.id_moneda=monedas.id_moneda INNER JOIN usuario
			on venta.idusuario=usuario.idusuario  INNER JOIN tipo_operaciones
			ON venta.id_operacion=tipo_operaciones.id_operacion
			 where idventa='$idventa'";
		//	echo $sql;
        return ejecutarConsultaSimpleFila($sql);
    }
    function obtener_detalle($idventa){
        $sql="SELECT detalle_venta.iddetalle_venta,detalle_venta.idventa,articulo.codigo_sunat,articulo.codigo_producto,articulo.nombre_producto,
		detalle_venta.cantidad,tipo_igvs.codigo_de_tributo,tipo_igvs.codigo as tipo_igv_codigo,detalle_venta.precio_venta,
		detalle_venta.id_tipo_igv,detalle_venta.descuento,detalle_venta.impuesto_bolsa,unidad_medida.codigo_unidad
		 FROM detalle_venta
		INNER JOIN articulo
		ON detalle_venta.idarticulo=articulo.idarticulo  INNER JOIN tipo_igvs
		ON detalle_venta.id_tipo_igv=tipo_igvs.id_tipo_igv inner join unidad_medida
		on articulo.idunidad_medida=unidad_medida.idunidad_medida WHERE idventa='$idventa'";
	return ejecutarConsulta($sql);

    }
	function total_del_dia(){
		$sql="SELECT modo_pago_desc,SUM(total_venta)AS total FROM venta INNER JOIN modo_pago
				ON venta.id_modo_pago=modo_pago.id_modo_pago
				WHERE DATE(fecha_emision)>=DATE(NOW())
				GROUP BY modo_pago_desc";
		return ejecutarConsulta($sql);

	}
	function obtener_UblExtension(){
		$sql="SELECT * FROM UblExtension";
		return ejecutarConsultaSimpleFila($sql);
	}
	function modificar_respuesta_sunat($idventa,$respuesta_sunat){
		$sql="UPDATE venta set respuesta_sunat='$respuesta_sunat' where idventa='$idventa'";
		return ejecutarConsulta($sql);
	}
	function errores_sunat($codigo_error,$idventa){
		//$estado_operacion=array("esta")
		if($codigo_error=='0'){
			$sql="UPDATE venta set estado_operacion=1
			WHERE idventa='$idventa'";
			return ejecutarConsulta($sql);
		}
	  // documento rechazado
		if(((int)$codigo_error>=2010)&&  ((int)$codigo_error <= 3999)){
			$sql="UPDATE venta set estado_operacion=2
			WHERE idventa='$idventa'";
			return ejecutarConsulta($sql);
		}

		
		
	}
	public function maximo_numero($fecha){
		$sql="SELECT MAX(numero) AS filas   FROM  anulaciones WHERE fecha='$fecha'";
		return ejecutarConsultaSimpleFila($sql);
	}
	public function insertar_anulacion($id_anulacion,$fecha,$numero,$idventa,$ticket,$respuesta){
		$sql="INSERT INTO anulaciones(id_anulacion,fecha,numero,idventa,ticket,respuesta)
		values('$id_anulacion','$fecha','$numero','$idventa','$ticket','$respuesta')";
		return ejecutarConsulta($sql);
	}
	public function modificar_estado_venta($idventa,$estado){
		$sql="UPDATE venta SET estado='$estado' where idventa='$idventa'";
		return ejecutarConsulta($sql);

	}
	public function select_anulaciones($idventa){
		$sql="SELECT id_anulacion,fecha,numero,idventa,ticket,respuesta FROM anulaciones
		where idventa='$idventa'";
		return ejecutarConsultaSimpleFila($sql);

	}
	public function total_letras($numero,$moneda){
		$sql="SELECT letras('$numero','$moneda') as letter";
		return ejecutarConsultaSimpleFila($sql);
	}
	 
	
}
?>