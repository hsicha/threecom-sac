<?php
ob_start();
if (strlen(session_id()) < 1){
	session_start();//Validamos si existe o no la sesión
}
require_once "../modelos/Usuario.php";

$usuario=new Usuario();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
//$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
//$num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
//$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
//$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
//$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";

$idusuario_sede=isset($_POST["idusuario_sede"])? limpiarCadena($_POST["idusuario_sede"]):"";
//$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (!isset($_SESSION["nombre"]))
		{
		  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else
		{
			//Validamos el acceso solo al usuario logueado y autorizado.
			if ($_SESSION['almacen']==1)
			{
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
						move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
					}
				}
				//Hash SHA256 en la contraseña
				$clavehash=hash("SHA256",$clave);

				if (empty($idusuario)){
					$rspta=$usuario->insertar($nombre,$email,$cargo,$clave,$_POST['permiso']);
					echo $rspta ? "Usuario registrado" : "No se pudieron registrar todos los datos del usuario";
					//echo $rspta;
				}
				else {
			$rspta=$usuario->editar($idusuario,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$imagen,$_POST['permiso']);
					echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
				}
			//Fin de las validaciones de acceso
			}
			else
			{
		  	require 'noacceso.php';
			}
		}		
	break;

	case 'cambiar_contraseña':
		if (!isset($_SESSION["nombre"]))
		{
		  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else
		{
			//Validamos el acceso solo al usuario logueado y autorizado.
			if ($_SESSION['almacen']==1)
			{
				$idusuario=$_POST["idusuario"];
				$contra=$_POST["contra"];
				$clavehash=hash("SHA256",$contra);
				$rspta=$usuario->cambiar_contraseña($idusuario,$contra);
				
 				echo $rspta ? "Contraseña Cambiada" : "ocurrio un error al cambiar contraseña";
			//Fin de las validaciones de acceso
			}
			else
			{
		  	require 'noacceso.php';
			}
		}		
	break;
		case 'combo_perfil':
		if (!isset($_SESSION["nombre"]))
		{
		  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else
		{
			//Validamos el acceso solo al usuario logueado y autorizado.
			if ($_SESSION['almacen']==1)
			{
				$rspta = $usuario->llenar_combo_perfil();
				while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->id_perfil . '>' . $reg->desc_perfil . '</option>';
				}
			//Fin de las validaciones de acceso
			}
			else
			{
		  	require 'noacceso.php';
			}
		}		
	break;


	case 'eliminar':
		if (!isset($_SESSION["nombre"]))
		{
		  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else
		{
			//Validamos el acceso solo al usuario logueado y autorizado.
			if ($_SESSION['almacen']==1)
			{
				$rspta=$usuario->eliminar($idusuario);
 				echo $rspta ? "Usuario eliminado" : "Usuario no se puede eliminar". $idusuario;
			//Fin de las validaciones de acceso
			}
			else
			{
		  	require 'noacceso.php';
			}
		}		
	break;

	case 'mostrar':
		if (!isset($_SESSION["nombre"]))
		{
		  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else
		{
			//Validamos el acceso solo al usuario logueado y autorizado.
			if ($_SESSION['almacen']==1)
			{
				$rspta=$usuario->mostrar($idusuario);
		 		//Codificar el resultado utilizando json
		 		echo json_encode($rspta);
			//Fin de las validaciones de acceso
			}
			else
			{
		  	require 'noacceso.php';
			}
		}		
	break;

	case 'listar':
		if (!isset($_SESSION["nombre"]))
		{
		  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else
		{
			//Validamos el acceso solo al usuario logueado y autorizado.
			if ($_SESSION['almacen']==1)
			{
				$rspta=$usuario->listar();
		 		//Vamos a declarar un array
		 		$data= Array();

		 		while ($reg=$rspta->fetch_object()){
		 			$data[]=array(
		 				"0"=>$reg->nro,
		 				"1"=>$reg->nombre,
		 				"2"=>$reg->email,
		 				"3"=>$reg->desc_perfil,
		 				"4"=>'<span class="label bg-primary flat text-center"><a style="color:white;cursor:pointer"  onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-edit"></i></a></span>'." ".
                    '<span class="label bg-red flat text-center"><a style="color:white;cursor:pointer"  onclick="eliminar('.$reg->idusuario.')"><i class="fa fa-trash" aria-hidden="true"></i></a></span>'." ".'<span class="label bg-yellow flat text-center"><a style="color:white;cursor:pointer"  onclick="cambiar_clave('.$reg->idusuario.')"><i class="fa fa-key" aria-hidden="true"></i></a></span>'
		 			
		 				);
		 		}
		 		$results = array(
		 			"sEcho"=>1, //Información para el datatables
		 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		 			"aaData"=>$data);
		 		echo json_encode($results);
			//Fin de las validaciones de acceso
			}
			else
			{
		  	require 'noacceso.php';
			}
		}
	break;

	case 'permisos':
		//Obtenemos todos los permisos de la tabla permisos
		require_once "../modelos/Usuario_Sede.php";
		$permiso = new Usuario_Sede();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $usuario->listarmarcados($id);
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idpermiso);
			}

		//Mostramos la lista de permisos en la vista y si están o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermiso,$valores)?'checked':'';
				//	echo '<li class="checkbox-inline"> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
		echo '<label class=" checkbox-inline"> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</label>';
				}
	break;

	case 'verificar':
		$empresa=$usuario->datos_empresa();
	        $_SESSION["nombre_comercial"]=$empresa["nombre_comercial"];
	        $_SESSION["nombre_empresa"]=$empresa["nom_empresa"];
	        $_SESSION["ruc_empresa"]=$empresa["ruc"];
	        $_SESSION["direccion_empresa"]=$empresa["domicilio_fiscal"];
		$_SESSION["tel_empresa"]=$empresa["telefono_movil"];
		
		$logina=$_POST['logina'];
	        $clavea=$_POST['clavea'];
	    //Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clavea);

		$rspta=$usuario->verificar($logina, $clavea);
		
	
		$fetch=$rspta->fetch_object();

	

		if (isset($fetch))
	    {
	    
	        //Declaramos las variables de sesión
	        $_SESSION['idusuario']=$fetch->idusuario;
	        $_SESSION['nombre']=$fetch->nombre;
	        $_SESSION['login']=$fetch->login;
	        
	       
		
		


	        //Obtenemos los permisos del usuario
	       
	    /*	$marcados = $usuario->listarmarcados($fetch->idusuario);

	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->idpermiso);
				}

			//Determinamos los accesos del usuario
			in_array(1,$valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
			in_array(2,$valores)?$_SESSION['almacen']=1:$_SESSION['almacen']=0;
			in_array(3,$valores)?$_SESSION['compras']=1:$_SESSION['compras']=0;
			in_array(4,$valores)?$_SESSION['ventas']=1:$_SESSION['ventas']=0;
			in_array(5,$valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
			in_array(6,$valores)?$_SESSION['consultac']=1:$_SESSION['consultac']=0;
			in_array(7,$valores)?$_SESSION['consultav']=1:$_SESSION['consultav']=0;
			in_array(9,$valores)?$_SESSION['tipodoc']=1:$_SESSION['tipodoc']=0;
			in_array(10,$valores)?$_SESSION['orden_serv']=1:$_SESSION['orden_serv']=0;
			in_array(11,$valores) ? $_SESSION['configuracion']=1 : $_SESSION['configuracion'] = 0;
			in_array(12,$valores) ? $_SESSION['control']=1 : $_SESSION['control'] = 0;
			*/

	    }
	    echo json_encode($fetch);
	    
	    
	break;
	case 'acceder_sistema':
	
		//$idusuario_=$_SESSION["idusuario"];
		
	//	$sede=$usuario->obtener_sede($idusuario_sede,$idusuario);
	//	echo json_encode($sede);
		/*
		$_SESSION['idsede']=$sede['idsede'];
		$_SESSION['sede']=$sede['sede'];
		$_SESSION['logo']=$sede['empresa'];
		*/
		
		
			$marcados = $usuario->listarmarcados($idusuario);
			

	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->idpermiso);
				}

			//Determinamos los accesos del usuario
			in_array(1,$valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
			in_array(2,$valores)?$_SESSION['almacen']=1:$_SESSION['almacen']=0;
			in_array(3,$valores)?$_SESSION['compras']=1:$_SESSION['compras']=0;
			in_array(4,$valores)?$_SESSION['ventas']=1:$_SESSION['ventas']=0;
			in_array(5,$valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
			in_array(6,$valores)?$_SESSION['consultac']=1:$_SESSION['consultac']=0;
			in_array(7,$valores)?$_SESSION['consultav']=1:$_SESSION['consultav']=0;
			in_array(9,$valores)?$_SESSION['tipodoc']=1:$_SESSION['tipodoc']=0;
			in_array(10,$valores)?$_SESSION['orden_serv']=1:$_SESSION['orden_serv']=0;
			in_array(11,$valores) ? $_SESSION['configuracion']=1 : $_SESSION['configuracion'] = 0;
			in_array(12,$valores) ? $_SESSION['control']=1 : $_SESSION['control'] = 0;
	    
	     echo json_encode($valores);
	     
		$sede=$usuario->obtener_sede($idusuario_sede,$idusuario);
		$_SESSION['idsede']=$sede['idsede'];
		$_SESSION['sede']=$sede['sede'];
		$_SESSION['logo']=$sede['empresa'];
		//echo json_encode($sede);
		
	break;
	case 'listar_sucursales':
		$idusuario=$_SESSION["idusuario"];
		$rspta=$usuario->listar_sucursales($idusuario);
		$data= Array();
		while($reg=$rspta->fetch_object()){
			$data[]=array(
			"0"=>$reg->nro,
			"1"=>$reg->NOMBRE_SEDE,
			"2"=>'<span class="label bg-yellow  text-center"><a style="color:white;cursor:pointer" onclick="acceder('.$reg->idusuario.','.$reg->idusuario_sede.')"><i class="fa fa-arrow-right" aria-hidden="true"></i> INGRESAR</a></span>' ,);
		}
		$results = array(
		 			"sEcho"=>1, //Información para el datatables
		 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		 			"aaData"=>$data);
		 		echo json_encode($results);
	break;
	case 'obtener_empresa':
		 $empresa=$usuario->datos_empresa();
	        $_SESSION["nombre_comercial"]=$empresa["nombre_comercial"];
	        $_SESSION["nombre_empresa"]=$empresa["nom_empresa"];
	        $_SESSION["ruc_empresa"]=$empresa["ruc"];
	        $_SESSION["direccion_empresa"]=$empresa["domicilio_fiscal"];
		$_SESSION["tel_empresa"]=$empresa["telefono_movil"];
		$_SESSION["logo_empresa"]=$empresa["logo"];
	break;
	case 'salir':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

	break;
}
ob_end_flush();
?>