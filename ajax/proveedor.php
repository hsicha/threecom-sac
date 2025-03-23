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
require_once "../modelos/Proveedor.php";

$proveedor=new Proveedor();

$idproveedor=isset($_POST["idProveedor"])? limpiarCadena($_POST["idProveedor"]):"";
$tipo_doc=isset($_POST["idTipoDoc"])? limpiarCadena($_POST["idTipoDoc"]):"";
$num_documento=isset($_POST["nro_doc"])? limpiarCadena($_POST["nro_doc"]):"";
$razon_social=isset($_POST["razon_social"])? limpiarCadena($_POST["razon_social"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$estado_sunat=isset($_POST["estado_sunat"])? limpiarCadena($_POST["estado_sunat"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idproveedor)){
			$prv=$proveedor->verificar_existencia($num_documento);
			$totalRows=mysqli_num_rows($prv);
			if($totalRows==0){
				$rspta=$proveedor->insertar($tipo_doc,$num_documento,$razon_social,$direccion,$telefono,$estado_sunat);
			echo $rspta ? "Proveedor registrada" : "Proveedor no se pudo registrar";
			}else{
				$rspta=$proveedor->obtener_proveedor($num_documento);
				$id_proveedor=$rspta['idproveedor'];
				$rspta=$proveedor->editar($id_proveedor,$tipo_doc,$num_documento,$razon_social,$direccion,$telefono);
			echo $rspta ? "Proveedor actualizada" : "Proveedor no se pudo actualizar";
				
			}
			
		}
		else {
			$rspta=$proveedor->editar($idproveedor,$tipo_doc,$num_documento,$razon_social,$direccion,$telefono);
			echo $rspta ? "Proveedor actualizada" : "Proveedor no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$proveedor->eliminar($idproveedor);
 		echo $rspta ? "Proveedor eliminada" : "Proveedor no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$proveedor->mostrar($idproveedor);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarp':
		$rspta=$proveedor->listarp();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->tipo_doc,
 				"1"=>$reg->nro_documento ,
 				"2"=>$reg->razon_social ,
				"3"=>$reg->direccion ,
 				"4"=>$reg->telefono,
 				"5"=>$reg->estado_sunat,
 				"6"=>'<span class="label bg-primary"><a style="color:white;cursor:pointer"  onclick="mostrar('.$reg->idproveedor.')"><i class="fa fa-edit"></i></a></span>'.' '.'<span class="label bg-red"><a style="color:white;cursor:pointer"  onclick="eliminar('.$reg->idproveedor.')"><i class="fa fa-trash" aria-hidden="true"></i></a></span>'
                   
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
			$rspta = $proveedor->select();

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