<?php
ob_start();
if(strlen(session_id())<1){
    session_start();
}
if(!isset($_SESSION["nombre"])){
    header('Location: ../vistas/login.html');
}else{
    if($_SESSION['ventas']==1){
        require_once '../modelos/Nota_Credito.php';
        
$serie_comprobante_1=isset($_POST['serie_comprobante_1'])?limpiarCadena($_POST['serie_comprobante_1']):"";
$numero_serie=isset($_POST['numero_serie'])?limpiarCadena($_POST['numero_serie']):"";
$id_venta1=isset($_POST["venta_id"])? limpiarCadena($_POST["venta_id"]):"";
$idventa=isset($_POST["idventa"])? limpiarCadena($_POST["idventa"]):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$idusuario=$_SESSION["idusuario"];
$id_usuario=isset($_POST["id_usuario"])? limpiarCadena($_POST["id_usuario"]):"";
$id_usuario=$idusuario;
$tipo_comprobante=isset($_POST["t_comprobante"])? limpiarCadena($_POST["t_comprobante"]):"";
$tipo_operacion=isset($_POST['tipo_ope'])?limpiarCadena($_POST["tipo_ope"]):"";
$serie_comprobante=isset($_POST["serie_comprobante"])? limpiarCadena($_POST["serie_comprobante"]):"";
$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$fecha_emision=isset($_POST["fecha_emision_nota"])? limpiarCadena($_POST["fecha_emision_nota"]):"";
$fecha_vencimiento=isset($_POST["fecha_venc"])? limpiarCadena($_POST["fecha_venc"]):"";
$hora= date("H:i:s");
$modo_pago=isset($_POST["modo_pago"])?limpiarCadena($_POST["modo_pago"]):"";
$id_moneda=isset($_POST["id_moneda"])?limpiarCadena($_POST["id_moneda"]):"";
$total_gravada=isset($_POST["sub_total"])?limpiarCadena($_POST["sub_total"]):"";
$total_igv=isset($_POST["igv"])?limpiarCadena($_POST["igv"]):"";
$total_gratuita=isset($_POST["total_gratuita"])? limpiarCadena($_POST["total_gratuita"]):"";
$total_venta=isset($_POST["total"])? limpiarCadena($_POST["total"]):"";
$nro_serie=isset($_POST["nro_serie"])? limpiarCadena($_POST["nro_serie"]):"";
$observaciones=isset($_POST["obs"])? limpiarCadena($_POST["obs"]):"";
$nro_ope=isset($_POST["n_op"])? limpiarCadena($_POST["n_op"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$serie_nota=isset($_POST["serie_nota"])? limpiarCadena($_POST["serie_nota"]):"";
$numero_nota=isset($_POST["numero_nota"])? limpiarCadena($_POST["numero_nota"]):"";
$tipo_ncredito=isset($_POST["tipo_ncredito"])? limpiarCadena($_POST["tipo_ncredito"]):"";

  $ncredito=new Nota_Credito();
       
        switch($_GET['op']){
			case 'guardaryeditar':
		if (empty($idventa)){
			$rspta=$ncredito->insertar($idcliente,
			$tipo_comprobante,
			1,
			$serie_nota,
			$numero_nota,
			$fecha_emision,
			$fecha_emision,
			$hora,
			1,
			1,
			$total_gravada,
			$total_igv,
			0,
			0,
			0,
			0,
			0,
			$total_venta,
			'',
			'Pendiente',
			$idusuario,
			"",
			"",
			1,
			'1.18',
			$tipo_ncredito,
			$serie_comprobante_1,
			$numero_serie,
			'',
			'',
			$_POST["idarticulo"],
			$_POST["cantidad"],
			1,
			$_POST["precio_venta"],
			$_POST["imp_total"],
			0);
			echo $rspta ? "Venta registrada" : "No se pudieron registrar todos los datos de la venta";
		}
		else {
		}
	break;
            case 'tipo_ncredito':
            	echo 'tipo_ncredito';
            	$rpta=$ncredito->listar_tipo_nota_credito();
            	
            	while($res=$rpta->fetch_object()){
            		echo '<option value='.$res->codigo_ncredito.'>'.$res->tipo_ncredito.'</option>';
            	}
            	break;
            case 'adjuntar_documento':
            	
				$rpta=$ncredito->listar_documento();
            	
            	while($res=$rpta->fetch_object()){
            		echo '<option value='.$res->documento.'>'.$res->documento.'</option>';
            	}
            	break;
            	
            	case 'obtener_venta':
            	
            	$rpta=$ncredito->obtener_venta_cabecera("BBB1-0000002");
            	//echo $rpta;
            	 echo json_encode( $rpta,JSON_UNESCAPED_UNICODE);
            	 break;
            	 
           case 'selectDocumento':
			$rspta=$ncredito->llenar_comdo_documento($idusuario);
			echo '<option value=0 >Seleccione</option>';
			while ($reg = $rspta->fetch_object())
					{
					echo '<option value=' . $reg->id_Tipodoc . '>' . $reg->comprobante . '</option>';
					}
		break;
		 case 'selectDocumento_Nota':
			$rspta=$ncredito->llenar_combo_Nota($idusuario);
			echo '<option value=0 >Seleccione</option>';
			while ($reg = $rspta->fetch_object())
					{
					echo '<option value=' . $reg->id_Tipodoc . '>' . $reg->comprobante . '</option>';
					}
		break;
		case "obtener_venta_cabecera":
		
		$rpta=$ncredito->obtener_venta_cabecera($serie_comprobante,$nro_serie);
			$data=array();
			while($reg=$rpta->fetch_object()){
				$data[]=$reg;
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
	break;

	case "obtener_venta_detalle":
		
		$rpta=$ncredito->obtener_detalle_venta($serie_comprobante,$nro_serie);
			$data=array();
			while($reg=$rpta->fetch_object()){
				$data[]=$reg;
	}
	//var_dump($serie_comprobante);exit;
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
	break;
        }
    }
    else{
        require 'noacceso.php';
    }
    ob_end_flush();
}
?>