<?php
require "../config/Conexion.php";

class TipoDocumento{
    function __construct(){

    }
    public function verificar_existencia($id_tpe_doc,$id_sede){
    	$sql="CALL SP_VERIFCAR_TIPO_DOC('$id_tpe_doc','$id_sede')";
    //	echo $sql;
	return ejecutarConsulta($sql);
    }
    public function insertar($idtipo_doc,$num_serie,$nro_inicial,$idsede)
    {
        $sql="CALL SP_INSERTAR_TIPO_DOC('$idtipo_doc','$num_serie','$nro_inicial','$idsede')";
        return ejecutarConsulta($sql);
       
    }
    public function editar($idtipo_documento,$idtipo_doc,$num_serie,$nro_inicial){
        $sql="CALL SP_ACTUALIZAR_TIPO_DOC('$idtipo_documento','$idtipo_doc','$num_serie','$nro_inicial')";
        return ejecutarConsulta($sql);
    }
    public function listar($idusuario){
        $sql="CALL SP_LISTAR_TIPO_DOC('$idusuario')";
        return ejecutarConsulta($sql);

    }
    public function mostrar($idtipo_documento){
        $sql="CALL SP_MOSTRAR_TIPO_DOC('$idtipo_documento') ";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function eliminar($idtipo_documento){
        $sql="CALL SP_ELIMINAR_TIPO_DOC('$idtipo_documento')";
        return ejecutarConsulta($sql);
    }
    public function activar($idtipo_documento){
        $sql="update tipo_documento set estado=1 where idtipo_documento='$idtipo_documento'";
        return ejecutarConsulta($sql);
    }
    //funcion del select
    public function select_documento(){
        $sql="select * from type_doc";
        return ejecutarConsulta($sql);
    }


}
?>