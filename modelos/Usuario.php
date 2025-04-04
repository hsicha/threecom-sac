<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$email,$cargo,$clave,$permisos)
	{
		$sql="INSERT INTO usuario (nombre,email,id_perfil,clave,condicion)
		VALUES ('$nombre','$email','$cargo','$clave','1')";
		//return ejecutarConsulta($sql);
	//	echo $sql;
		$idusuarionew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuarionew', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	//Implementamos un método para editar registros
	public function editar($idusuario,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$imagen,$permisos)
	{
		$sql="UPDATE usuario SET nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',direccion='$direccion',telefono='$telefono',email='$email',id_perfil='$cargo',login='$login',imagen='$imagen' WHERE idusuario='$idusuario'";
		ejecutarConsulta($sql);
	   echo $sql;
		//Eliminamos todos los permisos asignados para volverlos a registrar
		$sqldel="DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuario', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;

	}

	//Implementamos un método para desactivar categorías
	public function eliminar($idusuario)
	{
		$sql="CALL SP_ELIMINAR_USUARIO('$idusuario')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="CALL SP_LISTAR_USUARIOS()";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los permisos marcados
	public function listarmarcados($idusuario)
	{
		$sql="SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Función para verificar el acceso al sistema
	public function verificar($email,$clave)
    {
    	$sql="SELECT idusuario,nombre,tipo_documento,num_documento,telefono,email,id_perfil,imagen,login FROM usuario WHERE email='$email' AND clave='$clave' AND condicion='1'"; 
    
    	return ejecutarConsulta($sql);  
    }
	public function obtener_sede($idusuario_sede,$idusuario){
		$sql="CALL SP_OBTENER_SEDE('$idusuario_sede','$idusuario')";
	//	echo $sql;
		return ejecutarConsultaSimpleFila($sql);
	}
	public function llenar_combo_perfil(){
		$sql="CALL SP_LISTAR_COMBO_PERFIL()";
		return ejecutarConsulta($sql);
	}
	public function cambiar_contraseña($idusuario, $clave){
		
		$sql="CALL SP_CAMBIAR_CONTRASEÑA('$idusuario','$clave')";
	
		return ejecutarConsulta($sql);	
	}
	public function listar_sucursales($id_usuario){
		$sql="CALL SP_LISTAR_SUCURSALES('$id_usuario')";
		return ejecutarConsulta($sql);
		
	}
	public function datos_empresa(){
	$sql="select * from empresas";
        return ejecutarConsultaSimpleFila($sql);
	}
}

?>