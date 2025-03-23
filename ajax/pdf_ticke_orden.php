<?php

require_once ('../libraries/fpdf/fpdf.php');
require_once '../libraries/NumeroALetras.php';
require_once "../modelos/Venta.php";
require_once "../modelos/Orden_Servicio.php";
require_once "../libraries/Variables_diversas_model.php";
require_once "../libraries/efactura.php";
require_once '../libraries/qr/phpqrcode/qrlib.php';
session_start();
date_default_timezone_set('America/Lima');
$idorden=$_GET['id'];
$opc=$_GET['opc']; 

$idsede=$_SESSION["idsede"];
$variables_diversas_model=new variables_diversas_model();
$obj_venta=new Venta();
$obj_servicio=new Orden_Servicio();
$empresa=$obj_venta->obtener_empresa();

$sede=$obj_venta->obtener_sede($idsede); 


if($idorden!=0){
$servicio=$obj_servicio->pdf_ticket($idorden);
}else{
$id_orden=$obj_servicio->obtener_id_orden();
$id_orden_1=$id_orden["idOrden"];
$servicio=$obj_servicio->pdf_ticket($id_orden_1);
//echo print_r($servicio);
}


switch($opc){
    
    case "imprime_ticket":
        ticket_pdf($empresa,$sede,$servicio);
        
     break;
     case "imprime_ticket2":
       print_r($id_orden_1);
        
     break;
     
     
}
function pdf_obt($servicio){
	echo print_r($servicio);
}

function ticket_pdf($empresa,$sede,$servicio){

$pdf = new fpdf('P', 'mm', array(80, 240));
$pdf->AddPage();
$pdf->SetMargins(5, 5, 5,5);
//$pdf->MultiCell(70, 5,  $empresa["nombre_comercial"], 0, 'C');
//$pdf->Image('../files/logos/'.$empresa['logo'], 10, 0, 35,35);

$pdf->SetFont('Courier', 'B', 15);
$pdf->MultiCell(80, 5,  "ORDEN DE SERVICIO", 0, 'J');
$pdf->Ln(30);
$pdf->Image('../files/logos/'.$empresa['logo'], 20, 18, 35,25);
//$pdf->Ln(1);
$pdf->MultiCell(70, 5,  $empresa["nombre_comercial"], 0, 'C');
$pdf->SetFont('Courier', 'B', 10);
$pdf->MultiCell(70, 5, "RUC: ".  $empresa["ruc"], 0, 'C');

$pdf->Ln(1);
$pdf->SetFont('Courier', 'B', 10);
$pdf->MultiCell(70, 5, utf8_decode( $empresa["domicilio_fiscal"]), 0, 'C');
$pdf->Ln(1);
$pdf->MultiCell(70,5,utf8_decode("N°. ORDEN: " . $servicio["nro_orden"]), 0, 'C');
$pdf->Ln(1);
$pdf->Cell(70,5,utf8_decode("FECHA DE INGRESO: " . $servicio["fechaIngreso"]));
$pdf->Ln(5);
$pdf->MultiCell(70,5,utf8_decode("CLIENTE: " . $servicio["razon_social"]));
$pdf->Ln(1);
$pdf->Cell(70,5,utf8_decode("------------------------------------------------------"));
$pdf->Ln(5);
$pdf->MultiCell(70,5,utf8_decode("DATOS DEL EQUIPO"),0,"C");
$pdf->Ln(1);
$pdf->Cell(70,5,utf8_decode("------------------------------------------------------"));
$pdf->Ln(5);
$pdf->MultiCell(70,5,utf8_decode("EQUIPO: " .strtoupper($servicio["equipo"])));
$pdf->Ln(1);
$pdf->Cell(70,5,utf8_decode("MARCA: " . $servicio["marca"]));
$pdf->Ln(5);
$pdf->Cell(70,5,utf8_decode("MODELO: " . $servicio["modelo"]));
$pdf->Ln(5);
$pdf->Cell(70,5,utf8_decode("ACCESORIOS: " . $servicio["accesorios"]));
$pdf->Ln(3);
$pdf->Cell(70,5,utf8_decode("-------------------------------------------------------"));
$pdf->Ln(5);
$pdf->MultiCell(70,5,utf8_decode("PROBLEMA DEL EQUIPO"),0,"C");
$pdf->Ln(2);
$pdf->Cell(70,5,utf8_decode("-------------------------------------------------------"));
$pdf->Ln(3);
$pdf->MultiCell(70,5,utf8_decode("FALLA: ". $servicio["falla_equipo"]));
$pdf->Ln(1);
$pdf->MultiCell(70,5,utf8_decode("OBSERVACIONES: " . $servicio["observaciones"]));
$pdf->Ln(1);
$pdf->Cell(70,5,utf8_decode("----------------------------------------------------------"));
$pdf->Ln(5);
$pdf->Cell(70,5,utf8_decode("TOTAL. S/. ".$servicio["costo_total"]));
$pdf->Ln(5);
$pdf->Cell(70,5,utf8_decode("ADELANTO. S/. ".$servicio["adelanto"]));
$pdf->Ln(5);
$pdf->Cell(70,5,utf8_decode("DIFERENCIA. S/. " .$servicio["diferencia"]));
$pdf->Ln(10);
$pdf->SetFont('Courier', 'B', 10);
$pdf->MultiCell(70, 5,  "TERMINOS Y CONDICIONES", 0, 'C');
$pdf->Ln(1);
$pdf->SetFont('Courier', 'B', 10);
$pdf->MultiCell(70, 5,  utf8_decode($servicio["texto"] ));


$pdf->Output("I", $servicio["nro_orden"]."-".$servicio["razon_social"].".pdf");
//$pdf->Output("F", $servicio["nro_orden"]."-".$servicio["razon_social"].".pdf");
 $pdf->Output('pdf_ticket/'.$servicio["nro_orden"]."-".$servicio["razon_social"].'.pdf', 'F');    
//$pdf->Output("pdf_ticket/", $servicio["nro_orden"]."-".$servicio["razon_social"].".pdf",'F');

}

?>