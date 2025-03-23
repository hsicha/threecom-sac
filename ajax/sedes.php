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
if ($_SESSION['acceso']==1)
{
require_once "../modelos/Sedes.php";

$sede=new Sedes();

$idsede=isset($_POST["idsede"])? limpiarCadena($_POST["idsede"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$id_ubigeo=isset($_POST["id_ubigeo"])? limpiarCadena($_POST["id_ubigeo"]):"";
$ubigeo=isset($_POST["ubigeo"])? limpiarCadena($_POST["ubigeo"]):"";
$nombre_sede=isset($_POST["nombre_sede"])? limpiarCadena($_POST["nombre_sede"]):"";
$tel_celular=isset($_POST["tel_celular"])? limpiarCadena($_POST["tel_celular"]):"";
$anexo=isset($_POST["anexos"])? limpiarCadena($_POST["anexos"]):"";
switch ($_GET["op"]){
	case 'guardaryeditar':
		

		if (empty($idsede)){
			
			$rspta=$sede->insertar($direccion,$id_ubigeo,$ubigeo,$nombre_sede,$tel_celular,$anexo);
			echo $rspta ? "Sucursal registrada" : "Sucursal  no se pudo registrar";
			
		
	}  
		else {
			$rspta=$sede->editar($idsede,$direccion,$id_ubigeo,$ubigeo,$nombre_sede,$tel_celular,$idusuario,$codigo_almacen,'','',$anexo);
			echo $rspta ? "Empresa actualizada" : "Sede no se pudo actualizar";
		}
	break;

	case 'eliminar_sede':
		$rspta=$sede->eliminar_sede($idsede);
		
 		echo $rspta ? "Sede Eliminada" : "Empresa no se puede Eliminar";
	break;

	case 'activar':
		$rspta=$sede->activar($idsede);
 		echo $rspta ? "Empresa activada" : "Empresa no se puede activar";
	break;

	case 'mostrar':
		$rspta=$sede->mostrar($idsede);
		
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$sede->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 			"0"=>$reg->nro,
 			"1"=>$reg->NOMBRE_SEDE,
	 		"2"=>$reg->DIRECCION,
	                "3"=>$reg->local,
	                "4"=>$reg->TEL_CELULAR,
 			"5"=>'<span class="label bg-primary flat text-center"><a style="color:white;cursor:pointer"  onclick="mostrar('.$reg->ID_SEDE.')"><i class="fa fa-edit"></i></a></span>'." ".'<span class="label bg-red flat text-center"><a style="color:white;cursor:pointer"  onclick="elimianr_sede('.$reg->ID_SEDE.')"><i class="fa fa-trash" aria-hidden="true"></i></a></span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
    	case 'select_usuario':
		$rspta=$sede->select_usuario();
		while($reg=$rspta->fetch_object()){
			echo '<option value='.$reg->idusuario.'>'.$reg->nombre.'</option>';
		}
		break;
        case 'select_almacen':
		$rspta=$sede->select_almacen();
		while($reg=$rspta->fetch_object()){
			echo '<option value='.$reg->codigo_almacen.'>'.$reg->nombre.'</option>';
		}
		break;
	case 'obtener_ubigeo':
		$rspta=$sede->listar_ubigeo();

		while($reg=$rspta->fetch_object()){
			
			echo '<option value='.$reg->id_ubigeo.'>'.$reg->local.'</option>';
		}
		break;
		case 'obtener_codigo_ubigeo':
			$rpta=$sede->obtener_ubigeo($id_ubigeo);
		
			echo json_encode($rpta);
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