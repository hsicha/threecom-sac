<?php
require('../ws_sunat/lib/pclzip.lib.php'); 

require '../libraries/NumeroALetras.php';
require_once "../modelos/Venta.php";
require_once "../libraries/Variables_diversas_model.php";
require_once "../libraries/efactura.php";
session_start();

$idsede=$_SESSION["idsede"];
$idventa=163;
 $obj_variables_diversas_model=new variables_diversas_model();
$obj_venta=new Venta();
$empresa=$obj_venta->obtener_empresa();
$sede=$obj_venta->obtener_sede($idsede);
$venta=$obj_venta->obtener_venta($idventa);
$detalle=$obj_venta->obtener_detalle($idventa);
$UblExtension=$obj_venta->obtener_UblExtension();
/* header('Access-Control-Allow-Origin: *');
require '../libraries/NumeroALetras.php';
require_once "../modelos/Venta.php";

 $obj_venta=new Venta();
$venta=$obj_venta->obtener_venta(149);


       $total =number_format($venta['total_venta'], 2, '.');
       $totalVenta = explode(".",  $venta['total_venta']);
      // $venta['total_letras'] = $totalLetras.' con '.$totalVenta[1].'/100 '.$venta['moneda'];

$letras='Son'.':'.strtolower(NumeroALetras::convertir($total ,  $totalVenta[1].'/100 '.$venta['moneda'], "centimos"));
echo $letras;
 */
/* $totalVenta = explode(".",  $venta['total_venta']);
        if($totalVenta[0] == 0){
           $venta['total_letras'] = '0 '.$venta['moneda'];
        }else{
            $num = new Numletras();        
            $totalLetras = $num->num2letras($totalVenta[0]);
             echo $totalLetras;
          //  $venta['total_letras'] = $totalLetras.' con '.$totalVenta[1].'/100 '.$venta['moneda'];
           
        } */  
      /*   require_once "../modelos/Venta.php";
        
      print_r( array("prueba"=>"probando")); */
        
/* $ruta       = '../files/facturacion_electronica/FIRMA/';
$nombre_archivo = $empresa['ruc'].'-'.$venta['codigo_documento'].'-'.$venta['serie'].'-'.$venta['numero'];
//$NomArch    ='10775474888-01-FE001-00000000';
      $NomArch = $nombre_archivo;
      echo $NomArch;
      //$NomArch = '20604051984-07-FC01-6';
//$NomArch    = '20604051984-01-F001-100';

## =============================================================================
## Creación del archivo .ZIP

    ## Creación del archivo .ZIP
    $zip = new PclZip($ruta.$NomArch . ".zip");
    //var_dump($zip);exit;

    if(file_exists($ruta.$NomArch . ".zip")){
        $r = 1;
    }else{    
        $zip->add($ruta.$NomArch.".xml", PCLZIP_OPT_REMOVE_PATH, $ruta, PCLZIP_OPT_ADD_PATH, '');
    }

    $zip->create($NomArch . ".xml");
 //    var_dump($zip);
    chmod($ruta.$NomArch . ".zip", 0777); */
    //echo $ruta.$NomArch . ".zip";
    # ==============================================================================
    # Procedimiento para enviar comprobante a la SUNAT
    $codigos = $obj_variables_diversas_model->datos_codigo_tributo(10);
    var_dump($codigos["codigo_tributo"]);
?>