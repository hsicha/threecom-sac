<?php



ob_start();
if(strlen(session_id())<1){
    session_start();
}
if(!isset($_SESSION["nombre"])){
    header("Location:../vistas/login.html");
}else{
    if(($_SESSION['almacen']==1)){
        require_once "../modelos/Presentacion.php";

        $presentacion=new Presentacion();
        $idpresentacion=isset($_POST["idpresentacion"])?limpiarCadena($_POST["idpresentacion"]):"";
        $nombre=isset($_POST["nombre"])?limpiarCadena($_POST["nombre"]):"";
        $descripcion=isset($_POST["descripcion"])?limpiarCadena($_POST["descripcion"]):"";

        switch($_GET['op']){
            case 'guardaryeditar':
                if(empty($idpresentacion)){
                    $rspta=$presentacion->insertar($nombre,$descripcion);
                    echo $rspta ?"Marca Registrada":"no se pudo registrar la Presentacion";

                }else{
                    $rspta=$presentacion->editar($idpresentacion,$nombre,$descripcion);
                    echo $rspta ? "Marca Actualizada":"no se pudo actualizar Presentacion";

                }
                break;
                case 'eliminar_presentacion':
                    $rspta=$presentacion->eliminar_presentacion($idpresentacion);
                    echo $rspta ? "Presentacion Eliminado":"no se pudo desactivar la Presentacion";
                    break;
                case 'activar':
                    $rspta=$presentacion->activar($idpresentacion);
                    echo $rspta ? "Presentacion activada":"no se pudo activar la Presentacon";
                break;
                case 'mostrar':
                    $rspta=$presentacion->mostrar($idpresentacion);
                    echo json_encode($rspta);
                break;
                case 'listar':
                    $rspta=$presentacion->listar();
                    $data=Array();

                while($reg=$rspta->fetch_object()){
                    $data[]=array(
                    "0"=>$reg->nombre,
                    "1"=>$reg->descripcion,
                "2"=>'<span class="label bg-primary"><a style="color:white;cursor:pointer"  onclick="mostrar('.$reg->idpresentacion.')"><i class="fa fa-pencil"></i></a></span>'.' '.'<span class="label bg-red"><a style="color:white;cursor:pointer"  onclick="elimianr_presentacion('.$reg->idpresentacion.')"><i class="fa fa-trash" aria-hidden="true"></i></a></span>'
                    );
                }
                $results=array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data
                );
                echo json_encode($results);
            break;

        }       
    }else{
        require 'noacceso.php';
    }
}
ob_end_flush();


?>