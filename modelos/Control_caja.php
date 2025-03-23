<?php 
//Incluímos inicialmente la conexión a la base de datos
require __DIR__."/../config/Conexion.php";

Class Control_caja
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(
	$idservicio,
	$fecha,
	$cantidad,
	$precio,
	$total,
	$comision
    )
	{

		$sql = "INSERT INTO `detalle_servicio` (`iddetalle`, `id_servicio`, `fecha`, `cantidad`, `precio`, `total`, `comision`)
		VALUES (0,'$idservicio','$fecha','$cantidad','$precio','$total','$comision')";
		return ejecutarConsulta($sql);
	}


	public function listar($fecha)
	{
		$sql="SELECT detalle_servicio.iddetalle,servicio.nombre_servicio,
detalle_servicio.fecha, detalle_servicio.cantidad,
detalle_servicio.precio,detalle_servicio.total,detalle_servicio.comision FROM detalle_servicio INNER JOIN servicio
ON detalle_servicio.id_servicio=servicio.id_servicio
WHERE detalle_servicio.fecha='$fecha'";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros activos
	

	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	
	public function select()
	{
		$sql="SELECT * FROM servicio";
		return ejecutarConsulta($sql);		
	}
    function total_caja($fecha){
        $sql="SELECT SUM(total) AS total FROM detalle_servicio where fecha='$fecha'";
		return ejecutarConsultaSimpleFila($sql);	
    }
}

?>