
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
if ($_SESSION['tipodoc']==1)
{
require_once "../modelos/TipoDocumento.php";

$tipoDoc=new TipoDocumento();

$idtipo_documento=isset($_POST["idtipodocumento"])? limpiarCadena($_POST["idtipodocumento"]):"";
$codigo_documento=isset($_POST["codigo_doc"])? limpiarCadena($_POST["codigo_doc"]):"";
$serie=isset($_POST["serie"])? limpiarCadena($_POST["serie"]):"";
$numeracion=isset($_POST["numeracion"])? limpiarCadena($_POST["numeracion"]):"";
date_default_timezone_set('America/Lima');
$fecha_reg=date('Y-m-d H:i:s');
$idusuario=$_SESSION["idusuario"];
$idsede=$_SESSION['idsede'];

// convertimos a mayusculas

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idtipo_documento)){
			$rspta=$tipoDoc->insertar($codigo_documento,$serie,$numeracion,$idsede);
			$res=$rspta->fetch_object();
		    	 echo $res->msg;
		//
		}
		else {
			$rspta=$tipoDoc->editar($idtipo_documento,$codigo_documento, $serie,$numeracion);
			echo $rspta ? "REGISTRO ACTUALIZADO" : "OCURRIO UN ERROR AL ACTUALIZAR REGISTRO";
		}
	break;

	case 'eliminar':
		$rspta=$tipoDoc->eliminar($idtipo_documento);
 		echo $rspta ? "REGISTRO  ELIMINADO" : "OCURRIO UN ERROR AL ELIMINAR REGISTRO";
	break;

	case 'activar':
		$rspta=$tipoDoc->activar($idtipo_documento);
 		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
	break;

	case 'mostrar':
		$rspta=$tipoDoc->mostrar($idtipo_documento);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
	
	
		$rspta=$tipoDoc->listar($idsede);
		
		
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 		    "0"=>$reg->nro,
                    "1"=>$reg->documento,
                    "2"=>$reg->num_serie,
                    "3"=>$reg->nro_inicial,
                    "4"=>'<span class="label bg-primary flat text-center"><a style="color:white;cursor:pointer"  onclick="mostrar('.$reg->idtipo_documento.')"><i class="fa fa-edit"></i></a></span>'." ".
                    '<span class="label bg-red flat text-center"><a style="color:white;cursor:pointer"  onclick="eliminar('.$reg->idtipo_documento.')"><i class="fa fa-trash" aria-hidden="true"></i></a></span>'
 				);
 		}
 	
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	case 'select_doc':
		$rspta=$tipoDoc->select_documento();
		while($reg=$rspta->fetch_object()){
			echo '<option value='.$reg->idtipo_doc.'>'.$reg->nombre_tipo_doc.'</option>';
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