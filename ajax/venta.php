<?php 
require_once ('../libraries/fpdf/fpdf.php');
//header('Content-type: application/pdf');
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
if ($_SESSION['ventas']==1)
{
require_once "../modelos/Venta.php";
date_default_timezone_set('America/Lima');
$venta=new Venta();

$id_venta1=isset($_POST["venta_id"])? limpiarCadena($_POST["venta_id"]):"";
$idventa=isset($_POST["idventa"])? limpiarCadena($_POST["idventa"]):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$idusuario=$_SESSION["idusuario"];
$id_usuario=isset($_POST["id_usuario"])? limpiarCadena($_POST["id_usuario"]):"";
$id_usuario=$idusuario;
$tipo_comprobante=isset($_POST["tipo_comprobante"])? limpiarCadena($_POST["tipo_comprobante"]):"";
$tipo_operacion=isset($_POST['tipo_ope'])?limpiarCadena($_POST["tipo_ope"]):"";
$serie_comprobante=isset($_POST["serie_comprobante"])? limpiarCadena($_POST["serie_comprobante"]):"";
$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$fecha_emision=isset($_POST["fecha_emision"])? limpiarCadena($_POST["fecha_emision"]):"";
$fecha_vencimiento=isset($_POST["fecha_venc"])? limpiarCadena($_POST["fecha_venc"]):"";
$hora= date("H:i:s");
$modo_pago=isset($_POST["modo_pago"])?limpiarCadena($_POST["modo_pago"]):"";
$id_moneda=isset($_POST["id_moneda"])?limpiarCadena($_POST["id_moneda"]):"";
$total_gravada=isset($_POST["total_gravada"])?limpiarCadena($_POST["total_gravada"]):"";
$total_igv=isset($_POST["total_igv"])?limpiarCadena($_POST["total_igv"]):"";
$total_gratuita=isset($_POST["total_gratuita"])? limpiarCadena($_POST["total_gratuita"]):"";
$total_venta=isset($_POST["total_a_pagar"])? limpiarCadena($_POST["total_a_pagar"]):"";
$nro_doc=isset($_POST["nro_doc"])? limpiarCadena($_POST["nro_doc"]):"";
$observaciones=isset($_POST["obs"])? limpiarCadena($_POST["obs"]):"";
$nro_ope=isset($_POST["n_op"])? limpiarCadena($_POST["n_op"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$idsede=$_SESSION['idsede'];



switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idventa)){
			$rspta=$venta->insertar($idcliente,
			$tipo_comprobante,
			1,
			$serie_comprobante,
			$num_comprobante,
			$fecha_emision,
			$fecha_vencimiento,
			$hora,
			1,
			1,
			$total_gravada,
			$total_igv,
			$total_gratuita,
			0,
			0,
			0,
			0,
			$total_venta,
			'',
			'Pendiente',
			$idusuario,
			$observaciones,
			$nro_ope,
			$modo_pago,
			'1.18',
			'',
			'',
			'',
			'',
			'',
			$idsede,
			$_POST["idarticulo"],
			$_POST["cantidad"],
			1,
			$_POST["precio_venta"],
			$_POST["total"],
			0);
			echo $rspta ? "Venta registrada" : "No se pudieron registrar todos los datos de la venta";
		}
		else {
		}
	break;

	case 'enviar_documento':
		$estado_venta=$_POST["estado_venta"];
		$estado_ope=$_POST["estado_ope"];
		$respuesta_sunat=$_POST["respuesta_sunat"];
		$rspta=$venta->cambiar_estado($idventa,$estado_venta,$estado_ope,$respuesta_sunat);
 		echo $rspta ? "Venta Aceptado" : "Venta no se puede anular";
	break;

	case 'mostrar':
		$rspta=$venta->mostrar($idventa);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	

	

	case 'listar':
		$rspta=$venta->listar($idsede);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			
		
 			$data[]=array(
 					
 				"0"=>$reg->fecha_emision,
 				"1"=>$reg->nombre_tipo_doc,
 				
 				"2"=>'<span class="badge bg-aqua"><a class="" style="color:white;cursor:pointer"  onclick="mostrar('.$reg->idventa.')">'.$reg->comprobante.'</a></span>' ,
 				"3"=>$reg->razon_social,
 				"4"=>$reg->modo_pago_desc,
 				"5"=>$reg->total_venta,
 				"6"=>($reg->estado=='Pendiente')?'<span class="badge bg-red"><a style="color:white;cursor:pointer"  onclick="enviar_sunat('.$reg->idventa.')">PENDIENTE</a></span>':
 				'<span class="badge bg-green">ACEPTADO</span>',
 				
				
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'selectDocumento':
		
		$rspta=$venta->llenar_comdo_documento($idsede);
	echo '<option value=0  >Seleccione</option>';
		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idtipo_documento . '>' . $reg->nombre_tipo_doc . '</option>';
				}
	break;

	case 'listarArticulosVenta':
		require_once "../modelos/Articulo.php";
		$articulo=new Articulo();

		$rspta=$articulo->listarActivosVenta();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idarticulo.',\''.$reg->nombre.'\',\''.$reg->precio_venta.'\')"><span class="fa fa-plus"></span></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->categoria,
 				"3"=>$reg->codigo,
 				"4"=>$reg->stock,
 				"5"=>$reg->precio_venta,
 				"6"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px' >"
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;
	case "autocompleteCliente":
		$filtro=filter_input(INPUT_GET,trim('term',FILTER_SANITIZE_STRING));
		$rpta=$venta->autocomplet_Cliente($filtro);
	$data=array();
	while($reg=$rpta->fetch_object()){
		$data[]=$reg;
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
	break;
		case "total_dia":
			$rspta=$venta->total_del_dia();
			$data=array();
		while($reg=$rspta->fetch_object()){
			$data[]=$reg;
		}
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
	break;
	
	case "autocomplete_producto":
		$filtro=filter_input(INPUT_GET,trim('term',FILTER_SANITIZE_STRING));
		$rpta=$venta->autocomplete_producto($filtro,$idsede);
		$data=array();
	while($reg=$rpta->fetch_object()){
		$data[]=$reg;
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
	break;
	case 'obtener_cliente':
		$rspta=$venta->obtener_clientes($nro_doc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
		break;
	case 'obtener_correlativo_venta':
			
		$rpta=$venta->obtener_generar_correlativo_venta($serie_comprobante);
		//echo "valor variable desde php ". $serie_comprobante;
		echo json_encode($rpta);
			
			
break;
case 'obtener_series_numero':
	$rpta=$venta->obtener_serie_doc_documento($tipo_comprobante,$idsede);
	echo json_encode ($rpta);
break;
case 'serie2':
	$mensaje_ok=false;
	$mensaje_resultado="no se encontro";
	$mensaje_serie="nose encontro";
	$rpta=$venta->obtener_2($tipo_comprobante,$id_usuario);
	if(mysqli_num_rows($rpta)>0){
		$mensaje_ok=true;
		$num=mysqli_fetch_array($rpta);
		$mensaje_resultado=$num[0];
		$mensaje_serie=$num[1];
	};
	$salidaJson=array("respuesta"=>$mensaje_ok,"resultado"=>$mensaje_resultado,"resultado2"=>$mensaje_serie);
	echo json_encode($salidaJson);

	break;
	//if(mysql_num_rows($rpta)>0){

	//}
case 'llenar_combo_tipo_ope':
	$rspta=$venta->llenar_comdo_tipoOp();
	while($reg=$rspta->fetch_object()){
		echo '<option value='.$reg->id_operacion.'>'.$reg->descripcion.'</option>';
	}
	break;
	case 'llenar_combo_monedas':
		$rspta=$venta->llenar_combo_moneda();
		while($reg=$rspta->fetch_object()){
			echo '<option value='.$reg->id_moneda.'>'.$reg->moneda.'</option>';
		}
		break;
	case 'llernar_combo_igv':
		$rspta=$venta->llenar_combo_igv();
		while ($reg=mysqli_fetch_array($rspta)) {
		$id_igv=$reg['id_tipo_igv'];
		$igv=$reg['tipo_igv'];
		$data[]=array("idigv"=>$id_igv,"igv"=>$igv);
    # code...
		}
			echo json_encode($data);
		break;

		
		case 'llenar_combo_igv2':
			$rspta=$venta->llenar_combo_igv();
			while($reg=$rspta->fetch_object()){
			echo '<option value='.$reg->id_tipo_igv.'>'.$reg->tipo_igv.'</option>';
		}
		break;
		case 'modo_pago':
			$rspta=$venta->forma_pago();
		//	echo '<option value=0 disabled>Seleccione</option>';
			while($reg=$rspta->fetch_object()){
			echo '<option value='.$reg->id_modo_pago.'>'.$reg->modo_pago_desc.'</option>';
			}
			break;
		// obtenemos registros para la creacion de xml
		case 'obtener_id_venta':
		$venta_id=$venta->obtener_id_venta();
		echo  json_encode($venta_id);
		
		break;
		// OBTENEMOS LOS CLIENTES PARA LA CONSULTA DE VENTAS
		case 'selectCliente':
		require_once "../modelos/Clientes.php";
		$cliente = new Cliente();

		$rspta = $cliente->listarC();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idcliente . '>' .$reg->num_documento.'-'. $reg->razon_social . '</option>';
				}
	break;


		// 

		
		
}		


}
else
{
  require 'noacceso.php';
}
}

ob_end_flush();
?>