<?php
ob_start();
if(strlen(session_id())<1){
    session_start();
}
if(!isset($_SESSION["nombre"])){
    header('Location: ../vistas/login.html');
}else{
    if($_SESSION['almacen']==1){
        require_once '../modelos/Almacen.php';
        $almacen=new Almacen();
        $idalmacen=isset($_POST['idalmacen'])?limpiarCadena($_POST['idalmacen']):"";
        $nombre=isset($_POST['nombre'])?limpiarCadena($_POST['nombre']):"";
        $descripcion=isset($_POST['descripcion'])?limpiarCadena($_POST['descripcion']):"";
        

        switch($_GET['op']){
            case "guardareditar":
                if(empty($idalmacen)){
                    $rpta=$almacen->insertar($nombre,$descripcion);
                    echo $rpta ? "Almacen creado":"Ocurrio un error al crear almacen";
                }else{
                    $rpta=$almacen->actualizar($idalmacen,$nombre,$descripcion);
                    echo $rpta ? "Almacen Actualizaddo":"Ocurrio un error al actualziar almacen";
                }
            break;
            case "mostrar_detalle":
                $rpta=$almacen->mostrar_detalle($idalmacen);
                echo json_encode($rpta);
                break;
                 case "desactivar":
                    $rpta=$almacen->desactivar($idalmacen);
                    echo $rpta ? "Almacen Desactivada" : "Almacen no se puede desactivar";
                    break;
                case "activar":
                    $rpta=$almacen->activar($idalmacen);
                    echo $rpta ? "Almacen Activado" : "Almacen no se puede activar";
                    break;
            case "listar":
                $rpta=$almacen->listar();
                $data=array();
                while($reg=$rpta->fetch_object()){
                    	$data[]=array(
 				
 				"0"=>$reg->nombre,
 				"1"=>$reg->descripcion,
 				"2"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>',
                 "3"=>'<span class="label bg-red"><a style="color:white;cursor:pointer"  onclick="mostrar('.$reg->codigo_almacen.')"><i class="fa fa-pencil"></i></a></span>'
 				);
                }
               $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
     case 'select_sedes':
		$rspta=$almacen->select_sedes();
		while($reg=$rspta->fetch_object()){
			echo '<option value='.$reg->ID_SEDE.'>'.$reg->NOMBRE_SEDE.'</option>';
		}
		break;

        }
    }
    else{
        require 'noacceso.php';
    }
    ob_end_flush();
}
?>