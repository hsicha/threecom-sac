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
require_once "../modelos/Usuario_Sede.php";

       $idusuario_sede=isset($_POST["id_sede_user"])?limpiarCadena($_POST["id_sede_user"]):"";
       $idUsuario=isset($_POST["idUsuario"])?limpiarCadena($_POST["idUsuario"]):"";
       $id_sede=isset($_POST["id_sede"])?limpiarCadena($_POST["id_sede"]):"";

$usuario_sede=new Usuario_Sede();

switch ($_GET["op"]){
	case 'guardar_usuario_sede':
               
                    $rspta=$usuario_sede->insertar_usuario_sede($idUsuario,$id_sede);
                    echo $rspta ?"Sucursal Asignado":"Ocurrio un Error";
				
               
          break;
        case 'actualizar_usuario_sede':
        	$rspta=$usuario_sede->actualizar_usuario_sede($idusuario_sede,$idUsuario,$id_sede);
                    echo $rspta ?"Sucursal Asignado Actualizado":"¡ Ocurrio un Error";
        break;
        case 'mostrar':
                $rspta=$usuario_sede->mostrar($id_sede);
                echo json_encode($rspta);
         break;
         
         case 'eliminar':
         	$rspta=$usuario_sede->eliminar_sede_usr($id_sede);
        	echo $rspta ?"Registro Eliminado":"¡ Ocurrio un Error";
         break;
	case 'listar_combo_user':
		$rspta=$usuario_sede->listar_usuario_combo();
	 		//Vamos a declarar un array
	
		 while($reg=$rspta->fetch_object()){
		 	echo '<option value='.$reg->idusuario. '>' . $reg->nombre . '</option>';
		 //print_r($reg->idusuario);
		 }
	break;
	
	case 'listar_combo_sede':
		$rspta=$usuario_sede->listar_sede_combo();
	 		//Vamos a declarar un array
	
		 while($reg=$rspta->fetch_object()){
		 	echo '<option value='.$reg->ID_SEDE. '>' . $reg->NOMBRE_SEDE . '</option>';
		 //print_r($reg->idusuario);
		 }
		//Obtenemos todos los permisos de la tabla permisos
	
	break;
	 case 'listar':
                    $rspta=$usuario_sede->listar_usuario_sede();
                    $data=Array();

                while($reg=$rspta->fetch_object()){
                    $data[]=array(                       
                    "0"=>$reg->nro,
                    "1"=>$reg->NOMBRE_SEDE,
                    "2"=>$reg->nombre,
                    "3"=>$reg->desc_perfil,
                    "4"=>'<span class="label bg-primary flat text-center"><a style="color:white;cursor:pointer"  onclick="mostrar('.$reg->idusuario_sede.')"><i class="fa fa-edit"></i></a></span>'." ".
                    '<span class="label bg-red flat text-center"><a style="color:white;cursor:pointer"  onclick="eliminar('.$reg->idusuario_sede.')"><i class="fa fa-trash" aria-hidden="true"></i></a></span>'
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
//Fin de las validaciones de acceso
}
else
{
  require 'noacceso.php';
}
}
ob_end_flush();
?>