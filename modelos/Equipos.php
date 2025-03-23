<?php
require __DIR__."/../config/Conexion.php";

Class  Equipos
{
function __construct(){

}
public function insertar($nombre,$modelo,$idmarca,$caracteristicas, $accesorios,$serie){
    $sql="INSERT INTO equipos (nombre,modelo,idMarca,caracteristicas,accesorios,serie)values
    ('$nombre','$modelo','$idmarca','$caracteristicas','$accesorios','$serie')";
    return ejecutarConsulta($sql);
}
public function editar($id_equipo,$nombre,$modelo,$idmarca,$caracteristicas, $accesorios,$serie){
    $sql="UPDATE equipos set nombre='$nombre',modelo='$modelo',idMarca='$idmarca',caracteristicas='$caracteristicas',accesorios='$accesorios',
    serie='$serie'
    where id_equipo='$id_equipo'";
    return ejecutarConsulta($sql);
}
public function listar_equipos(){
	$sql="SELECT id_equipo,equipos.nombre as equipo
    ,modelo,marca.nombre as marca, caracteristicas,accesorios,serie FROM equipos inner join marca 
	on equipos.idMarca=marca.idMarca";
	return ejecutarConsulta($sql);
	
}
public function listar($nombre){
    $sql="SELECT e.id_equipo as idequipo,e.nombre as equipo, e.modelo as modelo,m.nombre as marca from equipos e inner join marca m on e.idMarca=m.idMarca
   WHERE e.nombre like '%$nombre%' ";
    ejecutarConsulta($sql);
}
	public function selectMarca()
	{
		$sql="SELECT * FROM marca where estado=1";
		return ejecutarConsulta($sql);		
	}
		public function select_tipo_equipo()
	{
		$sql="SELECT * FROM tipo_equipo ";
		return ejecutarConsulta($sql);		
	}

    public function mostrar_equipo($id_equipo){
        $sql="SELECT * from equipos WHERE id_equipo='$id_equipo'";
        return ejecutarConsultaSimpleFila($sql);
    }

}

?>