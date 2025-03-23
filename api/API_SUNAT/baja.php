<?php
header('Access-Control-Allow-Origin: *');
header("HTTP/1.1");


$venta_id = $this->uri->segment(3);
$venta = $this->ventas_model->query_cabecera($venta_id);
$empresa = $this->empresas_model->select(2);
$anulaciones_dia = $this->anulaciones_model->maximo_numero(date("Y-m-d"));



$nombre_archivo = $empresa['ruc'].'-RA-'.date("Ymd").'-'.($anulaciones_dia + 1);
//$anulacion_previa = $this->anulaciones_model->select(2, array('numero', 'fecha'), array('venta_id' => $venta_id ));        

////////CREO XML
$xml = $this->desarrollo_xml_baja($empresa, $venta, ($anulaciones_dia + 1));

$nombre = FCPATH."files/facturacion_electronica/BAJA/XML/".$nombre_archivo.".xml"; 
$archivo = fopen($nombre, "w+");
fwrite($archivo, $xml);
fclose($archivo);

$this->firmar_xml($nombre_archivo.".xml", $empresa['modo'], 1);



//enviar a Sunat       
//cod_1: Select web Service: 1 factura, boletas --- 9 es para guias
//cod_2: Entorno:  0 Beta, 1 Produccion
//cod_3: ruc
//cod_4: usuario secundario USU(segun seha beta o producción)
//cod_5: usuario secundario PASSWORD(segun seha beta o producción)
//cod_6: Accion:   1 enviar documento a Sunat --  2 enviar a anular  --  3 enviar ticket
//cod_7: serie de documento
//cod_8: numero ticket

$user_sec_usu = ($empresa['modo'] == 1) ? $empresa['usu_secundario_produccion_user'] : $empresa['usu_secundario_prueba_user'];
$user_sec_pass = ($empresa['modo'] == 1) ? $empresa['usu_secundario_produccion_password'] : $empresa['usu_secundario_prueba_passoword'];        
$ws = base_url()."ws_sunat/index_baja.php?numero_documento=".$nombre_archivo."&cod_1=1&cod_2=".$empresa['modo']."&cod_3=".$empresa['ruc']."&cod_4=".$user_sec_usu."&cod_5=".$user_sec_pass."&cod_6=2";
//echo $ws;exit;

$data = file_get_contents($ws);
$info = json_decode($data, TRUE);

/////////GUARDO EN BBDD

//var_dump($info['ticket']);

$data = array(
    'fecha'     =>  date("Y-m-d"),
    'venta_id'  =>  $venta_id,
    'numero'    =>  ($anulaciones_dia + 1),
    'ticket'    =>  $info['ticket'][0]
);

if($info['ticket'][0] != null){
    $this->ventas_model->modificar($venta_id, array('estado_anulacion' => 0));
    $this->anulaciones_model->insertar($data);
}                        

echo json_encode(array('ticket' => $info['ticket'][0]), JSON_UNESCAPED_UNICODE);

function desarrollo_xml_baja($empresa, $venta, $identificador){
        $xml = '<?xml version="1.0" encoding="ISO-8859-1"?><VoidedDocuments xmlns="urn:sunat:names:specification:ubl:peru:schema:xsd:VoidedDocuments-1" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:sac="urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1" xmlns:ds="http://www.w3.org/2000/09/xmldsig#">
                <ext:UBLExtensions>
                    <ext:UBLExtension>
                        <ext:ExtensionContent></ext:ExtensionContent>
                    </ext:UBLExtension>
                </ext:UBLExtensions>
                <cbc:UBLVersionID>2.0</cbc:UBLVersionID>
                <cbc:CustomizationID>1.0</cbc:CustomizationID>
                <cbc:ID>RA-'.date("Ymd").'-'.$identificador.'</cbc:ID>
                <cbc:ReferenceDate>'.$venta['fecha_emision_sf'].'</cbc:ReferenceDate>
                <cbc:IssueDate>'.date("Y-m-d").'</cbc:IssueDate>
                <cac:Signature>
                    <cbc:ID>'.$empresa['ruc'].'</cbc:ID>
                    <cac:SignatoryParty>
                        <cac:PartyIdentification>
                            <cbc:ID>'.$empresa['ruc'].'</cbc:ID>
                        </cac:PartyIdentification>
                        <cac:PartyName>
                            <cbc:Name>'.$empresa['empresa'].'</cbc:Name>
                        </cac:PartyName>
                    </cac:SignatoryParty>
                    <cac:DigitalSignatureAttachment>
                        <cac:ExternalReference>
                            <cbc:URI>'.$empresa['ruc'].'</cbc:URI>
                        </cac:ExternalReference>
                    </cac:DigitalSignatureAttachment>
                </cac:Signature>
                <cac:AccountingSupplierParty>
                    <cbc:CustomerAssignedAccountID>'.$empresa['ruc'].'</cbc:CustomerAssignedAccountID>
                    <cbc:AdditionalAccountID>6</cbc:AdditionalAccountID>
                    <cac:Party>
                        <cac:PartyLegalEntity>
                            <cbc:RegistrationName>'.$empresa['empresa'].'</cbc:RegistrationName>
                        </cac:PartyLegalEntity>
                    </cac:Party>
                </cac:AccountingSupplierParty>
                <sac:VoidedDocumentsLine>
                    <cbc:LineID>1</cbc:LineID>
                    <cbc:DocumentTypeCode>'.$venta['tipo_documento_codigo'].'</cbc:DocumentTypeCode>
                    <sac:DocumentSerialID>'.$venta['serie'].'</sac:DocumentSerialID>
                    <sac:DocumentNumberID>'.$venta['numero'].'</sac:DocumentNumberID>
                    <sac:VoidReasonDescription>Anulacion de la Operacion</sac:VoidReasonDescription>
                </sac:VoidedDocumentsLine>
            </VoidedDocuments>';
        return $xml;
    }