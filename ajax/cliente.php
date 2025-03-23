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
if ($_SESSION['ventas']==1 || $_SESSION['compras']==1)
{
require_once "../modelos/Clientes.php";

$cliente=new Cliente();

$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$tipo_doc=isset($_POST["idTipoDoc"])? limpiarCadena($_POST["idTipoDoc"]):"";
$num_documento=isset($_POST["nro_doc"])? limpiarCadena($_POST["nro_doc"]):"";
$razon_social=isset($_POST["razon_social"])? limpiarCadena($_POST["razon_social"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$estado_sunat=isset($_POST["estado_sunat"])? limpiarCadena($_POST["estado_sunat"]):"";

	$nombre_cliente=strtoupper($razon_social);
	$direcc_cliente=strtoupper($direccion);
switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($idcliente)){
			$cli=$cliente->verificar_existencia($num_documento);
			$totalRows=mysqli_num_rows($cli);
			if($totalRows==0){
			
				$rspta=$cliente->insertar($tipo_doc,$num_documento,$nombre_cliente,$direcc_cliente,$telefono,$estado_sunat);
			echo $rspta ? "Cliente registrada" : "Cliente no se pudo registrar";
			}else{
				$rspta=$cliente->obtener_idcliente($num_documento);
				$id_cliente=$rspta['idcliente'];
				$rspta=$cliente->editar($id_cliente,$tipo_doc,$num_documento,$nombre_cliente,$direcc_cliente,$telefono);
			echo $rspta ? "Datos del cliente actualizada" : "datos del cliente  no se pudo actualizar";
				
			}
			
		}
		else {
			$rspta=$cliente->editar($idcliente,$tipo_doc,$num_documento,$nombre_cliente,$direcc_cliente,$telefono);
			echo $rspta ? "Cliente actualizada" : "Proveedor no se pudo actualizar";
			
		}
	break;

	case 'eliminar':
		$rspta=$cliente->eliminar($idcliente);
 		echo $rspta ? "Cliente eliminada " : "Cliente no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$cliente->mostrar($idcliente);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar_cliente':
		$rspta=$cliente->listarc();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->tipo_doc,
 				"1"=>$reg->num_documento ,
 				"2"=>$reg->razon_social ,
				"3"=>$reg->direccion ,
 				"4"=>$reg->telefono,
 				"5"=>$reg->estado_sunat,
 				"6"=>'<span class="label bg-primary"><a style="color:white;cursor:pointer"  onclick="mostrar('.$reg->idcliente.')"><i class="fa fa-edit"></i></a></span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	
	case "select_tipo_doc":
			$rspta = $cliente->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->cod_tipo_doc. '>' . $reg->descripcion_documento. '</option>';
				}
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