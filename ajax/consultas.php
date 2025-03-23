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
if ($_SESSION['consultac']==1 || $_SESSION['consultav']==1)
{
require_once "../modelos/Consultas.php";

$consulta=new Consultas();

$idsede=$_SESSION['idsede'];
$ruc_empresa=$_SESSION["ruc_empresa"];
switch ($_GET["op"]){
	case 'comprasfecha':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];

		$rspta=$consulta->comprasfecha($fecha_inicio,$fecha_fin);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->fecha,
 				"1"=>$reg->usuario,
 				"2"=>$reg->proveedor,
 				"3"=>$reg->tipo_comprobante,
 				"4"=>$reg->serie_comprobante.' '.$reg->num_comprobante,
 				"5"=>$reg->total_compra,
 				"6"=>$reg->impuesto,
 				"7"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
 				'<span class="label bg-red">Anulado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'download_file':
		$nom_file=$_POST['nom_file'];
		echo $nom_file;
		$url = "http://apis.sichasoft.com/DEMO_API_SUNAT/files/facturacion_electronica/FIRMA/".$nom_file.'.xml';
		///$url = 'https://example.com/archivo.ext'; // Cambia esto por tu URL de archivo
		
		// Inicializa una nueva sesión cURL
		$ch = curl_init($url);
		
		// Configura la sesión cURL
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		// Ejecuta la sesión cURL
		$data = curl_exec($ch);
		
		// Verifica si hubo algún error
		if ($data === false) {
		    echo "Error al descargar el archivo: " . curl_error($ch);
		    curl_close($ch);
		    exit;
		}
		
		// Cierra la sesión cURL
		curl_close($ch);
		
		// Define el nombre del archivo descargado
		$filename = basename($url);
		
		// Envía encabezados para forzar la descarga del archivo
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header('Content-Length: ' . strlen($data));
		
		// Envía el contenido del archivo
		echo $data;


	break;

	case 'ventasfechacliente':
	


		$rspta=$consulta->reporte_general_ventas($idsede);
 		//Vamos a declarar un array
 		$data= Array();
 		

 		while ($reg=$rspta->fetch_object()){
 			
 			$nombre=trim($ruc_empresa."-".$reg->codigo_documento."-".$reg->documento.".xml");
 			
 			$doc = explode("-",$reg->documento);
 			
 			$serie = substr($doc[0], 0, 3);
 			$serieNum = substr($doc[0], 3, 3);
 			
 			if($serie == "BBB"){
 				$serieFan = "888".$serieNum;
 			}elseif($serie == "FFF"){
 				$serieFan = "999".$serieNum;
 			}else{
 				$serieFan = $reg->documento;
 			}
 			
 			$ruta_xml='https://apis.sichasoft.com/DEMO_API_SUNAT/files/facturacion_electronica/FIRMA/'.$nombre;
 			$ruta_pdf='www.demo.sichasoft.com/api/API_SUNAT/files/facturacion_electronica/PDF/';
 			$data[]=array(
 				"0"=>$reg->fecha_emision,
 				"1"=>$reg->nombre_tipo_doc,
 				"2"=>$reg->documento,
 				"3"=>$reg->cliente,
 				"4"=>$reg->total_venta,
 				"5"=>$reg->respuesta_sunat,
 				"6"=>'<span class="badge bg-aqua"><a onclick="dowload_file('.strval($ruc_empresa).', '.strval($reg->codigo_documento).', '.$serieFan.', '.strval($doc[1]).');" style="color:white;cursor:pointer"><i class="fa fa-code" aria-hidden="true"></i> XML</a></span>'
 				.' '.'<span class="badge bg-yellow"><a onclick="dowload_file('.strval($ruc_empresa).', '.strval($reg->codigo_documento).', '.$serieFan.', '.strval($doc[1]).');" style="color:white;cursor:pointer"><i class="fa fa-file-code-o" aria-hidden="true"></i> CDR</a></span>'
				.' '.'<span class="badge bg-red"><a onclick="obtener_ruc_serie('.$reg->idventa.')" style="color:white;cursor:pointer"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a></span>'			
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	case 'obtener_ruc_serie_nume':
		$id_venta=$_POST["id_venta"];
		$rpta=$consulta->obtener_ruc_serie_numeracion($id_venta);
		echo json_encode($rpta);
		break;
	case 'descargar_pdf':
		if (isset($_GET['url'])) {
    $url = $_GET['url'];
    
    // Inicializar una sesión cURL
    $ch = curl_init($url);
    
    // Configurar opciones cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    // Obtener el contenido del archivo
    $data = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    
    // Configurar cabeceras para la descarga
    header('Content-Description: File Transfer');
    header('Content-Type: ' . $info['content_type']);
    header('Content-Disposition: attachment; filename="' . basename($url) . '"');
    header('Content-Length: ' . strlen($data));
    
    // Enviar el contenido del archivo
    echo $data;
	}
	break;
	case 'descargarXml':
		
		$url = $_REQUEST['nom_file'];;

		$handle = fopen($url, 'r');
		
		// Abre el archivo local donde se guardará el contenido
		$localFile = fopen('archivo_descargado123.xml', 'w');
		
		// Lee el contenido y lo guarda en el archivo local
		while ($data = fread($handle, 1024)) {
		    fwrite($localFile, $data);
		}
		
		// Cierra los flujos
		fclose($handle);
		fclose($localFile);
		echo json_encode('archivo_descargado123.xml');
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