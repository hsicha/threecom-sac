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
require_once "../modelos/Empresas.php";

$emp=new Empresa();

$id_empresa=isset($_POST["id_empresa"])? limpiarCadena($_POST["id_empresa"]):"";
$empresa=isset($_POST["empresa"])? limpiarCadena($_POST["empresa"]):"";
$nombre_comercial=isset($_POST["nombre_comercial"])? limpiarCadena($_POST["nombre_comercial"]):"";
$ruc=isset($_POST["ruc"])? limpiarCadena($_POST["ruc"]):"";
$domicilio_fiscal=isset($_POST["domicilio_fiscal"])? limpiarCadena($_POST["domicilio_fiscal"]):"";
$ubigeo=isset($_POST["ubigeo"])? limpiarCadena($_POST["ubigeo"]):"";
$telefono_fijo=isset($_POST["telefono_fijo"])? limpiarCadena($_POST["telefono_fijo"]):"";
$telefono_movil=isset($_POST["telefono_movil"])? limpiarCadena($_POST["telefono_movil"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
				{
					$imagen=$_POST["imagenactual"];
				}
				else 
				{
					$ext = explode(".", $_FILES["imagen"]["name"]);
					if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
					{
						$imagen = round(microtime(true)) . '.' . end($ext);
						move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/logos/" . $imagen);
					}
				}

		if (empty($id_empresa)){
			
			$rspta=$emp->insertar($empresa,$nombre_comercial,$ruc,$domicilio_fiscal,$telefono_fijo,$telefono_movil,$correo,$imagen);
			echo $rspta ? "Empresa registrada" : "Empresa no se pudo registrar";
			
		
	}
		else {
			$rspta=$emp->editar($id_empresa, $empresa,$nombre_comercial,$ruc,$domicilio_fiscal,$ubigeo,$telefono_fijo,$telefono_movil,$correo,$imagen);
			echo $rspta ? "Empresa actualizada" : "Empresa no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$emp->desactivar($id_empresa);
 		echo $rspta ? "Empresa Desactivada" : "Empresa no se puede desactivar";
	break;

	case 'activar':
		$rspta=$emp->activar($id_empresa);
 		echo $rspta ? "Empresa activada" : "Empresa no se puede activar";
	break;

	case 'mostrar':
		$rspta=$emp->mostrar($id_empresa);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$emp->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 		$data[]=array(
 		"0"=>$reg->nom_empresa,
 		"1"=>$reg->nombre_comercial,
                "2"=>$reg->ruc,
                "3"=>$reg->domicilio_fiscal,
                "4"=>"<img src='../files/logos/".$reg->logo."' height='50px' width='50px' >",
 		"5"=>($reg->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>',
 		"6"=>	'<span class="label bg-primary flat text-center"><a style="color:white;cursor:pointer"  onclick="mostrar('.$reg->id_empresa.')"><i class="fa fa-edit"></i></a></span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

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