<?php

ob_start();
if (strlen(session_id()) < 1){
	session_start();//Validamos si existe o no la sesión
}
if (!isset($_SESSION["nombre"]))
{
  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
}
else
{
//Validamos el acceso solo al usuario logueado y autorizado.
if ($_SESSION['almacen']==1)
{	
require_once __DIR__."/../modelos/Control_caja.php";

$caja=new Control_caja();

$idservicio=isset($_POST["cmb_servicio"])? limpiarCadena($_POST["cmb_servicio"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$precio=isset($_POST["precio"])? limpiarCadena($_POST["precio"]):"";
$total=isset($_POST["total"])? limpiarCadena($_POST["total"]):"";
$comision=isset($_POST["comision"])? limpiarCadena($_POST["comision"]):"";

switch($_GET['op']){
	case 'guardar_detalle':
		
			$rpta=$caja->insertar($idservicio,$fecha,$cantidad,$precio,$total,$comision);
			echo $rpta ? "Equipo Registrado":"Ocurrio un problema al registrar equipo";
	
		break;
		case 'listar':
				$rpta=$caja->listar($fecha);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rpta->fetch_object()){
 			$data[]=[$reg];	
				
 		}
 		//var_dump($data);
 		//$results = array("data"=>$data);
 		
 		echo json_encode($data);

	break;
	case 'select_servicio':
		echo '<option value=0>Seleccione</option>';
		$rpta=$caja->select();
			while($reg=$rpta->fetch_object())
		{
			echo '<option value='.$reg->id_servicio. '>' . $reg->nombre_servicio. '</option>';

		}
		break;
		
	case "obtener_total":
        $rpta=$caja->total_caja($fecha);
        echo json_encode($rpta);
		
}

}
}

