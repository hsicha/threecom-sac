<?php
require "../libraries/NumeroALetras.php";
require_once ('../libraries/fpdf/fpdf.php');
require_once "../modelos/Venta.php";
header('Access-Control-Allow-Origin: *');

session_start();

/* $array=$_POST['datosJson'];
$array_llegada=json_decode($array); */

/* $venta=get_object_vars($array_llegada->venta);
$idventa=$venta['venta_id'];
echo  "recibiendo data".$idventa;
 */
$id_venta=$_POST['id_venta'];
/* crear_pdf();

function crear_pdf(){

// extraccion de datos de la base de datos
$data =new Venta();
$empresa=$data->obtener_empresa();
$idsede=$_SESSION["idsede"];
$sede=$data->obtener_sede($idsede);
$venta_id=$data->obtener_id_venta();
$idventa=$venta_id["id"];
$venta=$data->obtener_venta($idventa);
$detalle=$data->obtener_detalle($idventa);
  // fin de los registros de la base de datos
$pdf = new FPDF('P', 'mm', array(80, 200));
$pdf->AddPage();
$pdf->SetMargins(5, 5, 5);
$pdf->Image('../files/empresa/logotodo.png', 30, 2, 23);
$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 9);
$pdf->MultiCell(70, 5,  $empresa["nombre_comercial"], 0, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(70, 5, "RUC: ".  $empresa["ruc"], 0, 'C');

$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(70, 5,  $empresa["domicilio_fiscal"], 0, 'C');
 $pdf->Ln(1);
 $pdf->Cell(74,1,"-----------------------------------------------------------------------------",0,0,'C');

$pdf->Ln(1);
switch ($venta['idtipo_doc']) {
        case '01':
            $tipo_documento = 'FACTURA';
            break;        
        case '03':
            $tipo_documento = 'BOLETA';
            break;        
    } 
    $pdf->Cell(74,5,utf8_decode($tipo_documento." DE VENTA"),0,0,'C'); 
    $pdf->Ln(4);
    $pdf->Cell(74,5,utf8_decode($venta["serie"]."-".$venta["numero"]),0,0,'C');  
     $pdf->Ln(4);
    $pdf->Cell(74,5,utf8_decode("Fecha Emisión")." ".$venta["fecha_emision"],0,0,'L');
     $pdf->Ln(4);
    $pdf->Cell(74,5,"Cajero(a)".":".$venta["nombre"],0,0,'L');
     $pdf->Ln(4);
     $pdf->Cell(74,1,"-----------------------------------------------------------------------------",0,0,'C');
// datos del cliente
 $pdf->Ln(2);
    $pdf->Cell(74,5,"Cliente".":".$venta["razon_social"],0,0,'L');
    
      switch ($venta['cod_tipo_doc']) {
        case '1':
            $tipo_documento_cliente = 'DNI';
            break;        
        case '6':
            $tipo_documento_cliente = 'RUC';
            break;        
    }    
    $pdf->Ln(4);
    $pdf->Cell(74, 5,utf8_decode($tipo_documento_cliente . ": ". $venta['num_documento']),0,1,'L');
// detalles



$pdf->Cell(70, 2, '-------------------------------------------------------------------------', 0, 1, 'L');

$pdf->Cell(10, 4, 'Cant.', 0, 0, 'L');
$pdf->Cell(30, 4, mb_convert_encoding('Descripción', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Cell(15, 4, 'Precio', 0, 0, 'C');
$pdf->Cell(15, 4, 'Importe', 0, 1, 'C');
$pdf->Cell(70, 2, '-------------------------------------------------------------------------', 0, 1, 'L');


// recorremos el array de  datos



while($item=$detalle->fetch_object()){
  $pdf->Cell(10, 4, $item->cantidad, 0, 0, 'C');
  $yInicio = $pdf->GetY();
    $pdf->MultiCell(30, 4, mb_convert_encoding($item->nombre_producto, 'ISO-8859-1', 'UTF-8'), 0, 'L');
    $yFin = $pdf->GetY();
      $pdf->SetXY(45, $yInicio);
    $pdf->Cell(15, 4,$item->precio_venta, 2, '.', ',', 0, 0, 'C');
    $pdf->SetXY(60, $yInicio);

    $pdf->SetXY(60, $yInicio);
    $pdf->Cell(15, 4,($item->cantidad)*($item->precio_venta), 0, 1, 'C');
    $pdf->SetY($yFin);
    $nombre = $venta['serie'].'-'.$venta['numero'];
}

// calculo de total grabada
$totalGrabada=$venta["total_venta"]/1.18;
$igv=$venta["total_venta"]-$totalGrabada;
//----------
$pdf->Ln(4);
    $pdf->Cell(74,1,"-----------------------------------------------------------------------------",0,1,'C');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 7, "", 0, 0, 'R');
    $pdf->Cell(20, 7, "Gravada" , 0, 0, 'L');

    $pdf->Cell(20, 7, "S/. " .number_format($totalGrabada,2,".",""), 0, 0, 'R');

      $pdf->Ln(6);
    
    $pdf->Cell(30,7,"",0,0,'R');
    $pdf->Cell(20,7,"IGV: 18% ",0,0,'L');
    $pdf->Cell(20,7,"S/. ".number_format($igv,2,".",""),0,0,'R');
    $pdf->Ln(7);

    $pdf->Cell(30,7,"",0,0,'R');
    $pdf->Cell(20,7,"Total:",0,0,'L');
    $pdf->Cell(20,7,"S/. ".$venta["total_venta"],0,1,'R');

$pdf->Output();  
 



   


  

} */



?>