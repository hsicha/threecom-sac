<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Orden_Servicio
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(
	$detalle_equipo,$idMarca,$modelo, $accesorios,$falla_equipo,$id_tipoEquipo,
		
	$idcliente,
	$idArea,
	$nro_orden,
	$fechaIngreso,
	$costo_total,
	$adelanto,
	$diferencia,
	$estado,
	$observaciones,
	$idusuario,
	$costo_repuesto,
	$solucion
	)
	{

		$sql = "CALL SP_INSERTAR_ORDEN_SERVICIO(
		'$detalle_equipo',
		'$idMarca',
		'$modelo',
		'$accesorios',
		'$falla_equipo',
		'$id_tipoEquipo',
		0,
		'$idcliente',
        '$idArea',
		'$nro_orden',
        '$fechaIngreso',
        '$costo_total',
        '$adelanto',
        '$diferencia',
        '$estado',
        '$observaciones',
		'$idusuario',
		0,
		'')";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar(
    $id_orden ,
    $id_cliente ,
	$id_area ,
	$fecha_ingreso ,
	$costo_total,
	$adelanto,
	$diferencia,
	$id_estado  ,
	$idequipo ,
	$observaciones
	)
	{
		$sql="CALL  SP_ACTUALIZAR_ORDEN_SERVICIO(
		'$id_orden',
		'$id_cliente',
		'$id_area',
		'$fecha_ingreso',
		'$costo_total',
		'$adelanto',
		'$diferencia',
		'$id_estado',
		'$idequipo',
		'$observaciones'
		 )";
		return ejecutarConsulta($sql);
	}
	// FIN DE LA FUNCION EDITAR
public function generara_numeroOrden(){
   $sql="SELECT nro_orden FROM orden_servicio ORDER BY idOrden DESC LIMIT 1";
		return ejecutarConsultaSimpleFila($sql);
}

	public function mostrar($idorden)
	{
		$sql="SELECT orden_servicio.idOrden,orden_servicio.nro_orden, orden_servicio.fechaIngreso,orden_servicio.idcliente,
 clientes.razon_social,clientes.telefono,orden_servicio.idequipo,
		equipos.detalle_equipo AS equipo,equipos.idMarca, marca.nombre AS marca,equipos.modelo,equipos.accesorios,equipos.falla_equipo,
		orden_servicio.idArea,areas.nombre_area,
		orden_servicio.id_estado, estado_orden.nombre_estado,orden_servicio.costo_total,
		orden_servicio.adelanto,orden_servicio.diferencia,observaciones,tipo_equipo.id_tipoEquipo,tipo_equipo.nombre_tipo
		FROM orden_servicio INNER JOIN equipos
		ON orden_servicio.idequipo = equipos.id_equipo INNER JOIN clientes
		ON orden_servicio.idcliente=clientes.idcliente INNER JOIN marca
		ON equipos.idMarca=marca.idMarca INNER JOIN areas
		ON orden_servicio.idArea=areas.idArea INNER JOIN estado_orden
		ON orden_servicio.id_estado=estado_orden.id_estado INNER JOIN tipo_equipo
		ON equipos.id_tipoEquipo=tipo_equipo.id_tipoEquipo
			WHERE orden_servicio.idOrden='$idorden'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar($_fecha)
	{
		$sql="CALL SP_LISTAR_ORDEN('$_fecha');";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros activos
		function autocomplete_Marca($nombre){
		$sql="SELECT idMarca, nombre from marca
		where nombre like '%$nombre%' ";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function select_area()
	{
		$sql="SELECT * FROM areas";
		return ejecutarConsulta($sql);		
	}
	public function select_rt()
	{
		$sql="SELECT * FROM rt";
		return ejecutarConsulta($sql);		
	}
	function obtener_Marca(){
		
		$sql="SELECT idMarca,nombre FROM marca  WHERE idMarca=(SELECT MAX(idMarca)FROM marca)";
		return ejecutarConsultaSimpleFila($sql); 
	}
	function seleccionar_estado(){
		$sql="SELECT * FROM estado_orden";
		return ejecutarConsulta($sql);	
	}
			public function select_tipo_equipo()
	{
		$sql="SELECT * FROM tipo_equipo ";
		return ejecutarConsulta($sql);		
	}
	function pdf_ticket($idorden){
		$sql="SELECT  orden_servicio.nro_orden, orden_servicio.fechaIngreso, UPPER(clientes.razon_social) AS razon_social,
			UPPER(equipos.detalle_equipo) AS equipo,UPPER(marca.nombre) AS marca,UPPER(equipos.modelo)AS modelo,
			UPPER(equipos.accesorios)AS accesorios,
			UPPER(equipos.falla_equipo) AS falla_equipo,UPPER(orden_servicio.observaciones)AS observaciones,
			estado_orden.nombre_estado,orden_servicio.costo_total,
			orden_servicio.adelanto,orden_servicio.diferencia ,
			'EN CASO DE NO RECOGER EL EQUIPO  20 DIAS DESPUÉS DE LA SOLUCIÓN SE CONSIDERA EN ESTADO DE ABANDONO, DEL CUAL NO NOS HACEMOS RESPONSABLE POR SU PERDIDA O DETERIORO.'
			AS texto
			FROM orden_servicio INNER JOIN equipos
			ON orden_servicio.idequipo = equipos.id_equipo INNER JOIN clientes
			ON orden_servicio.idcliente=clientes.idcliente INNER JOIN marca
			ON equipos.idMarca=marca.idMarca INNER JOIN areas
			ON orden_servicio.idArea=areas.idArea INNER JOIN estado_orden
			ON orden_servicio.id_estado=estado_orden.id_estado
			WHERE idOrden='$idorden'";
		return ejecutarConsultaSimpleFila($sql);
	}
	function obtener_id_orden(){
		$sql="SELECT MAX(idOrden) AS idOrden FROM orden_servicio";
		return ejecutarConsultaSimpleFila($sql);
	}
	function obtner_id_equipo(){
		$sql="SELECT id_equipo FROM equipos  WHERE id_equipo=(SELECT MAX(id_equipo)FROM equipos)";
		return ejecutarConsultaSimpleFila($sql);
	}
	public function insertar_Equipo($detalle_equipo,$idMarca,$modelo, $accesorios,$falla_equipo,$id_tipoEquipo){
    $sql="CALL SP_INSERTAR_EQUIPOS(0,'$detalle_equipo','$idMarca','$modelo','$accesorios','$falla_equipo','$id_tipoEquipo')";
    return ejecutarConsulta($sql);
}
public function editar_equipo($id_equipo,$detalle_equipo,$idMarca,$modelo, $accesorios,$falla_equipo,$id_tipoEquipo){
    $sql="CALL SP_ACTUALIZAR_EQUIPO('$id_equipo','$detalle_equipo','$idMarca','$modelo','$accesorios',
    '$falla_equipo','$id_tipoEquipo')";
    return ejecutarConsulta($sql);
}
// para modificar el estado del orden de servicio
function listar_estado_orden(){
	$sql="SELECT idOrden, fechaIngreso,nro_orden,CONCAT(clientes.num_documento,' - ',UPPER( clientes.razon_social)) AS cliente,
CONCAT(UPPER(equipos.detalle_equipo),' - ',UPPER(marca.nombre),' - ',UPPER(equipos.modelo)) AS equipo,
UPPER(equipos.falla_equipo) AS falla_equipo,UPPER(equipos.accesorios)AS accesorios,costo_total,adelanto,diferencia,estado_orden.nombre_estado
 FROM orden_servicio INNER JOIN clientes
 ON orden_servicio.idcliente=clientes.idcliente INNER JOIN equipos
 ON orden_servicio.idequipo=equipos.id_equipo INNER JOIN marca
 ON equipos.idMarca=marca.idMarca INNER JOIN estado_orden
 ON orden_servicio.id_estado=estado_orden.id_estado";
  return ejecutarConsulta($sql);
}
function mostrar_estado_orden($idorden){
	$sql="SELECT idOrden,nro_orden, costo_total,adelanto,diferencia,costo_repuesto,solucion,id_estado 
	FROM orden_servicio  WHERE idOrden='$idorden'";
return ejecutarConsultaSimpleFila($sql);
}
function select_estado_orden(){
	$sql="SELECT id_estado,nombre_estado FROM estado_orden";
	return ejecutarConsulta($sql);
	
}
function update_estado_orden($idOrden,$costo_total,$adelanto,$diferencia,$costo_repuesto,$solucion,$id_estado){
	$sql="UPDATE orden_servicio set costo_total='$costo_total',adelanto='$adelanto',diferencia='$diferencia',
	costo_repuesto='$costo_repuesto',solucion='$solucion',id_estado='$id_estado' where idOrden='$idOrden'";
	return ejecutarConsulta($sql);
	
}
}
?>