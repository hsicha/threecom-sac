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
require_once "../modelos/Orden_Servicio.php";

$ord_serv=new Orden_Servicio();

$idOrden=isset($_POST["idOrden"])? limpiarCadena($_POST["idOrden"]):"";
$idcliente=isset($_POST["idcliente"])?limpiarCadena($_POST["idcliente"]):"";
$cbo_situacion=isset($_POST["cbo_situacion"])? limpiarCadena($_POST["cbo_situacion"]):"";
$nro_orden=isset($_POST["num_orden"])?limpiarCadena($_POST["num_orden"]):"";
$fechaIngreso=isset($_POST["fecha_ingreso"])?limpiarCadena($_POST["fecha_ingreso"]):"";
$costo_cliente=isset($_POST["costo_total"])? limpiarCadena($_POST["costo_total"]):"";
$adelanto=isset($_POST["adelanto"])? limpiarCadena($_POST["adelanto"]):"";
$diferencia=isset($_POST["diferencia"])? limpiarCadena($_POST["diferencia"]):"";
$idestado=isset($_POST["id_estado"])? limpiarCadena($_POST["id_estado"]):"";

$idusuario=$_SESSION["idusuario"];
$observacion=isset($_POST["observacion"])? limpiarCadena($_POST["observacion"]):"";
//$idequipo=isset($_POST["idequipo"])? limpiarCadena($_POST["idequipo"]):"";


// datos del equipos

$idequipo=isset($_POST["idequipo"])? limpiarCadena($_POST["idequipo"]):"";
$detalle_equipo=isset($_POST["det_equipo"])? limpiarCadena($_POST["det_equipo"]):"";
$id_marca=isset($_POST["idmarca"])? limpiarCadena($_POST["idmarca"]):"";
$modelo=isset($_POST["modelo"])? limpiarCadena($_POST["modelo"]):"";
$accesorios=isset($_POST["accesorios"])? limpiarCadena($_POST["accesorios"]):"";
$falla_equipo=isset($_POST["falla_equipo"])? limpiarCadena($_POST["falla_equipo"]):"";
$idtipo_eq=isset($_POST["cbo_tipo_eq"])? limpiarCadena($_POST["cbo_tipo_eq"]):"";

$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
	
		if (empty( $idOrden && $idequipo)){
			$rpta=$ord_serv->insertar($detalle_equipo,$id_marca,$modelo,$accesorios,$falla_equipo,$idtipo_eq,$idcliente,$cbo_situacion,$nro_orden,$fechaIngreso
            ,$costo_cliente,$adelanto,$diferencia,1,$observacion,$idusuario,0,'');
           
			echo $rpta ? " ORDEN DE SERVICIO REGISTRADA CON EXITO" : "Orden no se pudo registrar";
		}
		else {
			$rpta=$ord_serv->editar_equipo($idequipo,$detalle_equipo,$id_marca,$modelo,$accesorios,$falla_equipo,$idtipo_eq);
			$rpta=$ord_serv->editar(
				$idOrden,
				$idcliente,
				$cbo_situacion,
				$fechaIngreso,
				$costo_cliente,
				$adelanto,
				$diferencia,
				1,
				$idequipo,
				$observacion
				);
				
			echo $rpta ? "Orden actualizado" : "Orden no se pudo actualizar";
		}
		
	break;
	
    case 'nro_orden':
        $rpta=$ord_serv->generara_numeroOrden();
        echo json_encode($rpta);
    break;


	case 'mostrar':
		$rspta=$ord_serv->mostrar($idOrden);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$fecha_=$_REQUEST["fecha"];
	//	var_dump($fecha_);
		$rspta=$ord_serv->listar($fecha_);
	
 		//Vamos a declarar un array
 		//$data= array("dataax"=>$rpta);
 		
 		$data= Array();

 		
 		while ($reg=$rspta->fetch_object()){
 			
 			$data[]=array(
 				"0"=>$reg->fechaIngreso,
				"1"=>$reg->nro_orden,
				"2"=>$reg->cliente,
 				"3"=>$reg->equipo,
 				"4"=>$reg->falla_equipo,
 				"5"=>$reg->accesorios,
 				"6"=>$reg->costo_total,
 				"7"=>$reg->adelanto,
 				"8"=>$reg->diferencia,
 				"9"=>'<span class="label bg-primary"><a style="color:white;cursor:pointer"  onclick="mostrar_detalle('.$reg->idOrden.')"><i class="fa fa-edit"></i></a></span> 
 				<span class="label bg-red"><a style="color:white;cursor:pointer"  onclick="imprimir_tick('.$reg->idOrden.')"><i class="fa fa-print"></i></a></span>
 				<span class="label bg-green"><a style="color:white;cursor:pointer"  onclick="enviar_whatsap('.$reg->idOrden.')"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></span>'
						
 			);
			
 		
 		}
 		
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		
 	
 		echo json_encode($results);

	break;

	case "autocomplete_Marca":
			$filtro=filter_input(INPUT_GET,trim('term',FILTER_SANITIZE_STRING));
			$rpta=$ord_serv->autocomplete_Marca($filtro);
			$data=array();
		while($reg=$rpta->fetch_object()){
			$data[]=$reg;
		}
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	break;
	case "select_area":
		$rpta=$ord_serv->select_area();
			while($reg=$rpta->fetch_object())
			{
				echo '<option value='.$reg->idArea. '>'.$reg->nombre_area.'</option>';
			}
		break;
		case 'select_tipo_equipo':
		echo '<option value=0>Seleccione</option>';
		$rpta=$ord_serv->select_tipo_equipo();
			while($reg=$rpta->fetch_object())
		{
			echo '<option value='.$reg->id_tipoEquipo. '>' . $reg->nombre_tipo . '</option>';

		}
		break;
	case "select_estado_orden":
	$rpta=$ord_serv->seleccionar_estado();
		while($reg=$rpta->fetch_object())
		{
			echo '<option value='.$reg->id_estado. '>'.$reg->nombre_estado.'</option>';
		}
	break;
	case 'obtener_Marca':
		$rpta=$ord_serv->obtener_Marca();
		echo json_encode($rpta);
	break;
	case 'id_equipo':
		$idMarca=$ord_serv->obtner_id_equipo();
		print_r( $idMarca["id_equipo"]);
		break;
		// para cambiar el estado del servicio
	case 'listar_estado_orden':
		$rspta=$ord_serv->listar_estado_orden();
 		//Vamos a declarar un array
 		//$data= array("dataax"=>$rpta);
 		
 		$data= Array();

 		
 		while ($reg=$rspta->fetch_object()){
 			$estado='';
 			if($reg->nombre_estado=="EN PROCESO"){
 		    //$estado="<span class='label bg-yellow'>".$reg->nombre_estado."</span>";
 		    $estado='<span class="label bg-yellow"><a style="color:white;cursor:pointer"  onclick="modificar_estado('.$reg->idOrden.')">'.$reg->nombre_estado.'</a></span>';
 			}
 			$data[]=array(
 				"0"=>$reg->fechaIngreso,
				"1"=>$reg->nro_orden,
				"2"=>$reg->cliente,
 				"3"=>$reg->falla_equipo,
 				"4"=>$estado,
							
 			);

 		
 		}
 		
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		
 	
 		echo json_encode($results);

	break;
	case 'mostrar_estado':
		$rspta=$ord_serv->mostrar_estado_orden($idOrden);
		echo json_encode($rspta);
		break;
		case 'mostrar_pdf':
		$rspta=$ord_serv->mostrar_estado_orden($idOrden);
		echo json_encode($rspta);
		break;

		
}

//Fin de las validaciones de acceso
}
else
{
  require 'noacceso.php';
}
}
ob_end_flush();
?>