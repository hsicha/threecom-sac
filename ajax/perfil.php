<?php


ob_start();
if(strlen(session_id())<1){
    session_start();
}
if(!isset($_SESSION["nombre"])){
    header("Location:../vistas/login.html");
}else{
    if(($_SESSION['almacen']==1)){
        require_once "../modelos/Perfil.php";
        $perfil=new Perfil();
        $idPerfil=isset($_POST["idPerfil"])?limpiarCadena($_POST["idPerfil"]):"";
        $descripcion=isset($_POST["descripcion"])?limpiarCadena($_POST["descripcion"]):"";

        switch($_GET['op']){
            case 'guardar_perfil':
               
                    $rspta=$perfil->insertar_perfil($descripcion);
                    echo $rspta ?"Perfil de usuario Registrada":"no se pudo registrar perfil de usuario";
				
               
                break;
                case 'actualizar_perfil':
                    $rspta=$perfil->editar_perfil($idPerfil,$descripcion);
                    echo $rspta ? "Perfil de usuario Actualizado":"no se pudo actualuzar perfil de usuario";
                    break;
                case 'eliminar_perfil':
                    $rspta=$perfil->eliminar_perfil($idPerfil);
                    echo $rspta ? "Perfil de usuario Eliminado":"no se pudo eliminar el perfil";
                break;
                case 'mostrar_perfil':
                    $rspta=$perfil->mostrar_perfil($idPerfil);
                    echo json_encode($rspta);
                break;
                case 'listar':
                    $rspta=$perfil->listar_perfil();
                    $data=Array();

                while($reg=$rspta->fetch_object()){
                    $data[]=array(                       
                    "0"=>$reg->nro,
                    "1"=>$reg->desc_perfil,
                    "2"=>'<span class="label bg-primary flat text-center"><a style="color:white;cursor:pointer"  onclick="mostrar('.$reg->id_perfil.')"><i class="fa fa-edit"></i></a></span>'." ".
                    '<span class="label bg-red flat text-center"><a style="color:white;cursor:pointer"  onclick="elimianr_perfil('.$reg->id_perfil.')"><i class="fa fa-trash" aria-hidden="true"></i></a></span>'
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