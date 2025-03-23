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
require_once __DIR__."/../modelos/Equipos.php";

$equipo=new Equipos();

$idequipo=isset($_POST["idequipo"])? limpiarCadena($_POST["idequipo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$modelo=isset($_POST["modelo"])? limpiarCadena($_POST["modelo"]):"";
$marca=isset($_POST["marca"])? limpiarCadena($_POST["marca"]):"";
$caracteristicas=isset($_POST["caracteristicas"])? limpiarCadena($_POST["caracteristicas"]):"";
$accesorios=isset($_POST["accesorios"])? limpiarCadena($_POST["accesorios"]):"";
$serie=isset($_POST["serie"])? limpiarCadena($_POST["serie"]):"";

switch($_GET['op']){
	case 'guardar_equipo':
		if(empty($idequipo)){
			$rpta=$equipo->insertar($nombre,$modelo,$marca,$caracteristicas,$accesorios,$serie);
			echo $rpta ? "Equipo Registrado":"Ocurrio un problema al registrar equipo";
		}else{
			$rpta=$equipo->editar($idequipo,$nombre,$modelo,$marca,$caracteristicas,$accesorios,$serie);
			echo $rpta ? "Equipo Actualizado":"Ocurrio un problema al actualizar equipo";
		}
		break;
		case 'listar_equipo':
				$rpta=$equipo->listar_equipos();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rpta->fetch_object()){
 			$data[]=array(
 				"equipo"=>$reg->equipo,
 				"modelo"=>$reg->modelo,
				"marca"=>$reg->marca,
 				"caracteristica"=>$reg->caracteristicas,
				"accesorio"=>$reg->accesorios,
				"serie"=>$reg->serie,
				"acciones"=>'<button class="btn btn-info" onclick="mostrar_detalle('.$reg->id_equipo.')"><i class="fa fa-edit"></i></button>',
 				);
 		}
 		//var_dump($data);
 		//$results = array("data"=>$data);
 		
 		echo json_encode($data);

	break;
	case 'select_marca':
		echo '<option value=0>Seleccione</option>';
		$rpta=$equipo->selectMarca();
			while($reg=$rpta->fetch_object())
		{
			echo '<option value='.$reg->idMarca. '>' . $reg->nombre . '</option>';

		}
		break;
			case 'select_tipo_equipo':
		echo '<option value=0>Seleccione</option>';
		$rpta=$equipo->select_tipo_equipo();
			while($reg=$rpta->fetch_object())
		{
			echo '<option value='.$reg->id_tipoEquipo. '>' . $reg->nombre_tipo . '</option>';

		}
		break;
		case 'mostrar_equipo':
			$rpta=$equipo->mostrar_equipo($idequipo);
		
			echo json_encode($rpta);
			break;
	
		
}

}
}

