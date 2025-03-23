<?php


ob_start();
if(strlen(session_id())<1){
    session_start();
}
if(!isset($_SESSION["nombre"])){
    header("Location:../vistas/login.html");
}else{
    if(($_SESSION['almacen']==1)){
        require_once "../modelos/Rt.php";

        $rt=new Rt();
        $idRt=isset($_POST["idRt"])?limpiarCadena($_POST["idRt"]):"";
        $nombre=isset($_POST["nombre"])?limpiarCadena($_POST["nombre"]):"";
       
        switch($_GET['op']){
            case 'guardaryeditar':
                if(empty($idRt)){
                    $rspta=$rt->insertar($nombre);
                    echo $rspta ?"Rt Registrada":"no se pudo registrar la marca";

                }else{
                    $rspta=$rt->editar($idRt,$nombre);
                    echo $rspta ? "Rt Actualizada":"no se pudo actualizar marca";

                }
                break;
               
                case 'mostrar':
                    $rspta=$rt->mostrar($idRt);
                    echo json_encode($rspta);
                break;
                case 'eliminar':
                    $rspta=$rt->eliminar($idRt);
                    echo $rspta ? "Rt Eliminado":"no se pudo actualizar marca";
                break;
                case 'listar':
                    $rspta=$rt->listar();
                    $data=Array();

                while($reg=$rspta->fetch_object()){
                    $data[]=array(
                        
                    "0"=>$reg->Nombres,
                    "1"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idRT.')"><i class="fa fa-pencil"></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idRT.')"><i class="fa fa-close"></i></button>',
                    
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