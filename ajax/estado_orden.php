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
$costo_total=isset($_POST["costo_total"])? limpiarCadena($_POST["costo_total"]):"";
$adelanto=isset($_POST["adelanto"])? limpiarCadena($_POST["adelanto"]):"";
$diferencia=isset($_POST["diferencia"])? limpiarCadena($_POST["diferencia"]):"";
$costo_repuesto=isset($_POST["costo_repuesto"])? limpiarCadena($_POST["costo_repuesto"]):"";
$solucion=isset($_POST["solucion"])? limpiarCadena($_POST["solucion"]):"";
$id_estado=isset($_POST["cbo_estado"])? limpiarCadena($_POST["cbo_estado"]):"";




switch ($_GET["op"]){
	
	case 'modificar_estado_orden':
		$rpta=$ord_serv->update_estado_orden($idOrden,$costo_total,$adelanto,$diferencia,$costo_repuesto,$solucion,$id_estado);
			echo $rpta ? " Estado del Orden Actualizado" : "Ocurrio un error al actualizar estado del orden";
		break;

	case "select_estado_orden":
	$rpta=$ord_serv->seleccionar_estado();
		while($reg=$rpta->fetch_object())
		{
			echo '<option value='.$reg->id_estado. '>'.$reg->nombre_estado.'</option>';
		}
	
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
 		    $estado='<span class="label bg-yellow"><a style="color:white;cursor:pointer"  onclick="modificar_estado('.$reg->idOrden.')"><i class="fa fa-circle-thin" aria-hidden="true"></i></a></span>';
 			}else{
 				if($reg->nombre_estado=="POR RECOGER"){
 					$estado='<span class="label bg-red"><a style="color:white;cursor:pointer"  onclick="modificar_estado('.$reg->idOrden.')"><i class="fa fa-info-circle" aria-hidden="true"></i></a></span>';
 				}else{
 					if($reg->nombre_estado=="ENTREGADO"){
 						$estado='<span class="label bg-green "><i class="fa fa-check-circle" aria-hidden="true"></i></span>';
 					}else{
 					$estado='<span class="label bg-red"><a style="color:white;cursor:pointer"  onclick="modificar_estado('.$reg->idOrden.')">'.$reg->nombre_estado.'</a></span>';	
 					}
 				}
 				
 			}
 			$data[]=array(
 				"0"=>$reg->fechaIngreso,
				"1"=>$reg->nro_orden,
				"2"=>$reg->cliente,
 				"3"=>$reg->falla_equipo,
 				"4"=>$estado.' '. '<span class="label bg-red"><a style="color:white;cursor:pointer"  onclick="imprimir_tick('.$reg->idOrden.')"><i class="fa fa-print"></i></a></span>'
							.' '.'<span class="label bg-green"><a style="color:white;cursor:pointer"  onclick="enviar_whatsap('.$reg->idOrden.')"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></span>'
							
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