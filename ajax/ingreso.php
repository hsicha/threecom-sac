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
if ($_SESSION['compras']==1)
{

require_once "../modelos/Ingreso.php";

$ingreso=new Ingreso();

$idingreso=isset($_POST["idingreso"])? limpiarCadena($_POST["idingreso"]):"";
$idproveedor=isset($_POST["idproveedor"])? limpiarCadena($_POST["idproveedor"]):"";
$idusuario=$_SESSION["idusuario"];
$tipo_comprobante=isset($_POST["tipo_comprobante"])? limpiarCadena($_POST["tipo_comprobante"]):"";
$serie_comprobante=isset($_POST["serie_comprobante"])? limpiarCadena($_POST["serie_comprobante"]):"";
$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
//$impuesto=isset($_POST["impuesto"])? limpiarCadena($_POST["impuesto"]):"";
$total_gravada=isset($_POST["total_gravada"])? limpiarCadena($_POST["total_gravada"]):"";
$total_igv=isset($_POST["total_igv"])? limpiarCadena($_POST["total_igv"]):"";
$total_compra=isset($_POST["total_a_pagar"])? limpiarCadena($_POST["total_a_pagar"]):"";
$nro_doc=isset($_POST["nro_doc"])? limpiarCadena($_POST["nro_doc"]):"";
$idsede=$_SESSION['idsede'];

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idingreso)){
		$rspta=$ingreso->insertar($idproveedor,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$total_gravada,$total_igv,$total_compra,$idsede,$_POST["idarticulo"],$_POST["cantidad"],$_POST["precio_venta"],$_POST["total"]);
		
		///---------!!!-------------
			echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos del ingreso";
				
		}
		else {
		}
	break;

	case 'anular':
		$rspta=$ingreso->anular($idingreso);
 		echo $rspta ? "Ingreso anulado" : "Ingreso no se puede anular";
	break;

	case 'mostrar':
		$rspta=$ingreso->mostrar($idingreso);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	

	case 'listar':
		$rspta=$ingreso->listar($idsede);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->fecha,
 				"1"=>$reg->tipo_comprobante,
 				"2"=>'<button class=" btn badge bg-aqua" onclick="abrir_detalle('.$reg->idingreso.')">'.$reg->serie_comprobante.'-'.$reg->num_comprobante.'</button>',
 				"3"=>$reg->proveedor,
 				"4"=>$reg->nro_documento,
 				"5"=>"S/. ".$reg->total_compra,
 			
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'selectProveedor':
		require_once "../modelos/Persona.php";
		$persona = new Persona();

		$rspta = $persona->listarP();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idpersona . '>' . $reg->nombre . '</option>';
				}
	break;

	case 'listarArticulos':
		

			$filtro=filter_input(INPUT_GET,trim('term',FILTER_SANITIZE_STRING));
		$rpta=$ingreso->listar_productos($filtro,$idsede);
	$data=array();
	while($reg=$rpta->fetch_object()){
		$data[]=$reg;
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
	
	break;
	case "selectTipoDoc":
		

		$rspta = $ingreso->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->cod_tipo_doc. '>' . $reg->descripcion_documento. '</option>';
				}
	break;
	case "autocompleteProveedor":
		$filtro=filter_input(INPUT_GET,trim('term',FILTER_SANITIZE_STRING));
		$rpta=$ingreso->autocomplet_Prov($filtro);
	$data=array();
	while($reg=$rpta->fetch_object()){
		$data[]=$reg;
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
	break;
	case 'obtener_proveedor':
		$rspta=$ingreso->obtener_proveedores($nro_doc);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
		break;
		case 'obtener_cabecera_compra':
		$rspta=$ingreso->cabecera_compra($idingreso);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
		// detalle compra
		case 'obtener_detalle_compra':
				$rspta=$ingreso->detalle_compra($idingreso);
				$data=array();
				while($reg=$rspta->fetch_object()){
				$data[]=$reg;
				
				}
				echo json_encode($data,JSON_UNESCAPED_UNICODE);
		break;
		
}




function aumentar_stk($idarticulo,$stock){
	$idarticulo=$ingreso->obtener_stock($idarticulo);
	$stock_actual=0;
	while($res=mysql_fetch_array($idarticulo)){
		$stock_actual=$res[0];
	}
	$stock_actual+=$stock;
	$rpta=$ingreso->actualizar_stock($idarticulo,$stock);
	echo $rpta;
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