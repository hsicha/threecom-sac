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
require_once __DIR__."/../modelos/Articulo.php";

$articulo=new Articulo();


$idarticulo=isset($_POST["idProducto"])? limpiarCadena($_POST["idProducto"]):"";
$cod_sunat=isset($_POST["cod_sunat"])?limpiarCadena($_POST["cod_sunat"]):"";
$cod_prod=isset($_POST["cod_prod"])? limpiarCadena($_POST["cod_prod"]):"";
$nombre_prod=isset($_POST["descripcion"])?limpiarCadena($_POST["descripcion"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$idmarca=isset($_POST["idmarca"])?limpiarCadena($_POST["idmarca"]):"";
$idpresentacion=isset($_POST["idpresentacion"])? limpiarCadena($_POST["idpresentacion"]):"";
$id_unidMed=isset($_POST["umedida"])? limpiarCadena($_POST["umedida"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
//$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$pre_venta=isset($_POST["pre_venta"])? limpiarCadena($_POST["pre_venta"]):"";
$pre_costo=isset($_POST["precio_costo"])? limpiarCadena($_POST["precio_costo"]):"";
$idsde=$_SESSION['idsede'];

switch ($_GET["op"]){
	case 'guardaryeditar':

	
		if (empty($idarticulo)){
			$rspta=$articulo->insertar($cod_sunat,$cod_prod,$nombre_prod,$idcategoria,$idmarca,$idpresentacion,$id_unidMed,$stock,$pre_venta,$pre_costo,$idsde);
			
			echo $rspta ? "Artículo registrado" : "Artículo no se pudo registrar";
		}
		else {
			$rspta=$articulo->editar($idarticulo,$cod_sunat,$cod_prod,$nombre_prod, $idcategoria,$idmarca,$idpresentacion,$id_unidMed,$stock,"",$pre_venta,$pre_costo);
			echo $rspta ? "Artículo actualizado" : "Artículo no se pudo actualizar";
		}
	break;

	case 'eliminar_prod':
		$rspta=$articulo->eliminar_producto($idarticulo);
 		echo $rspta ? "Producto Eliminado" : "Producto no se puede eliminar  por que tiene una venta";
	break;

	case 'activar':
		$rspta=$articulo->activar($idarticulo);
 		echo $rspta ? "Artículo activado" : "Artículo no se puede activar";
	break;

	case 'mostrar':
		$rspta=$articulo->mostrar($idarticulo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$articulo->listar($idsde);
 		//Vamos a declarar un array
 		$data= Array();
		$stk='';
 		while ($reg=$rspta->fetch_object()){
 			if($reg->stock<=10){
 			 $stk='<span class="badge bg-red">'.$reg->stock.'</span>';	
 			}else{
 				$stk='<span class="badge bg-green">'.$reg->stock.'</span>';
 			}
 				$data[]=array(
 				"0"=>$reg->nro,
 				"1"=>$reg->UM,
 				"2"=>$reg->codigo_producto,
				"3"=>$reg->nombre_producto,
 				"4"=>$reg->MARCA,
				"5"=>$stk,
				"6"=>$reg->PRECIO_COSTO,
				"7"=>$reg->PRECIO_VENTA,
 				"8"=>'<span class="label bg-primary"><a style="color:white;cursor:pointer"  onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-edit"></i></a></span>'. ' '.'<span class="label bg-red"><a style="color:white;cursor:pointer"  onclick="elimianr_producto('.$reg->idarticulo.')"><i class="fa fa-trash" aria-hidden="true"></i></a></span>'
 			
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectCategoria":
		require_once "../modelos/Categoria.php";
		$categoria = new Categoria();

		$rspta = $categoria->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre . '</option>';
				}
	break;
	case "selectMarca":
		require_once "../modelos/Marca.php";
		$marca=new Marca();
		$rspta=$marca->select();
		
		while($reg=$rspta->fetch_object())
		{
			echo '<option value='.$reg->idMarca. '>' . $reg->nombre . '</option>';

		}
		break;
		case "selectUmedida":
			require_once "../modelos/Articulo.php";
			$articulo=new Articulo();
			$rpta=$articulo->select();
			while($reg=$rpta->fetch_object())
			{
				echo '<option value='.$reg->idunidad_medida. '>'.$reg->descr_unidad.'</option>';
			}
			break;
			case "selectPresentacion":
				require_once "../modelos/Presentacion.php";
				$presentacion=new Presentacion();
				$rspta=$presentacion->select();
				while($reg=$rspta->fetch_object()){
					echo '<option value='.$reg->idpresentacion.'>' .$reg->nombre.'</option>';
				}
				break;
				case 'stock_minimo':
					$rspta=$articulo->listar_stock_minimo($idsde);
			 		//Vamos a declarar un array
			 		$data= Array();
			
			 		while ($reg=$rspta->fetch_object()){
			 			$stk='';
			 			if($reg->stock<=2){
			 					$stk='<span class="badge bg-red">'.$reg->stock.'</span>';
			 					
			 			}else if($reg->stock>2){
			 					$stk='<span class="badge bg-yellow">'.$reg->stock.'</span>';
			 				
			 			}

			 			$data[]=array(
			 			
			 				"0"=>$reg->codigo_producto,
			 				"1"=>$reg->nombre_producto,
			 				"2"=>$reg->MARCA,
							"3"=>$stk,
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