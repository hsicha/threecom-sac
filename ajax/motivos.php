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
require_once __DIR__."/../modelos/Motivos.php";

$motivo_=new Motivos();

$idmotivo=isset($_POST["idmotivo"])? limpiarCadena($_POST["idmotivo"]):"";
$nombre_area=isset($_POST["nombre_area"])? limpiarCadena($_POST["nombre_area"]):"";


switch($_GET['op']){
	case 'guardar_registro':
		if(empty($idmotivo)){
			$rpta=$motivo_->insertar($nombre_area,'Activo');
			echo $rpta ? "Motivo Registrado":"Ocurrio un problema al registrar Motivos";
		}else{
			$rpta=$motivo_->editar($idmotivo,$nombre_area);
			echo $rpta ? "Motivo Actualizado":"Ocurrio un problema al actualizar equipo";
		}
		break;
		case 'listar_Motivo':
				$rpta=$motivo_->listar_registros();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rpta->fetch_object()){
 			$data[]=array(
 				"motivo"=>$reg->nombre_area,
 				"estado"=>'<span class="label bg-green">'.$reg->estado.'</span>',
				"acciones"=>'<button class="btn btn-info" onclick="mostrar_detalle('.$reg->idArea .')"><i class="fa fa-edit"></i></button>',
 				);
 		}
 		//var_dump($data);
 		//$results = array("data"=>$data);
 		
 		echo json_encode($data);

	break;

		case 'mostrar_registros':
			$rpta=$motivo_->mostrar_registros($idmotivo);
			echo json_encode($rpta);
			break;
	
		
}

}
}

