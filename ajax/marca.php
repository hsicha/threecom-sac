<?php


ob_start();
if(strlen(session_id())<1){
    session_start();
}
if(!isset($_SESSION["nombre"])){
    header("Location:../vistas/login.html");
}else{
    if(($_SESSION['almacen']==1)){
        require_once "../modelos/Marca.php";

        $marca=new Marca();
        $idMarca=isset($_POST["idmarca"])?limpiarCadena($_POST["idmarca"]):"";
        $nombre=isset($_POST["nombre"])?limpiarCadena($_POST["nombre"]):"";
        //$descripcion=isset($_POST["descripcion"])?limpiarCadena($_POST["descripcion"]):"";

        switch($_GET['op']){
            case 'guardaryeditar':
                if(empty($idMarca)){
                    $rspta=$marca->insertar($nombre);
                    echo $rspta ?"Marca Registrada":"no se pudo registrar la marca";

                }else{
                    $rspta=$marca->editar($idMarca,$nombre);
                    echo $rspta ? "Marca Actualizada":"no se pudo actualizar marca";

                }
                break;
                case 'eliminar_marca':
                    $rspta=$marca->eliminar_marca($idMarca);
                    echo $rspta ? "Marca Eliminada":"no se pudo eliminar la marca";
                    break;
               
                case 'mostrar':
                    $rspta=$marca->mostrar($idMarca);
                    echo json_encode($rspta);
                break;
                case 'listar':
                    $rspta=$marca->listar();
                    $data=Array();

                while($reg=$rspta->fetch_object()){
                    $data[]=array(                       
                    "0"=>$reg->nro,
                    "1"=>$reg->nombre,
                 
                "2"=>'<span class="label bg-primary"><a style="color:white;cursor:pointer"  onclick="mostrar('.$reg->idmarca.')"><i class="fa fa-edit"></i></a></span>'.' '.'<span class="label bg-red"><a style="color:white;cursor:pointer"  onclick="eliminar_marca('.$reg->idmarca.')"><i class="fa fa-trash" aria-hidden="true"></i></a></span>'
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