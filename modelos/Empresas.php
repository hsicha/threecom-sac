<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Empresa
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar(
	$empresa,
	$nombre_comercial,
	$ruc,
	$domicilio_fiscal,
	$telefono_fijo,
	$telefono_movil,
	$correo,
	$logo
	
	)
	{

		$sql = "INSERT INTO empresas(nom_empresa,nombre_comercial,ruc,domicilio_fiscal,telefono_fijo,telefono_movil,correo,logo,estado)
		VALUES ('$empresa','$nombre_comercial','$ruc','$domicilio_fiscal','$telefono_fijo','$telefono_movil','$correo','$logo','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($id_empresa,
	$empresa,
	$nombre_comercial,
	$ruc,
	$domicilio_fiscal,
	$ubigeo,
	$telefono_fijo,
	$telefono_movil,
	$correo,
	$logo
	)
	{
		$sql="UPDATE empresas SET nom_empresa='$empresa',
		nombre_comercial='$nombre_comercial',
		ruc='$ruc',
		 domicilio_fiscal='$domicilio_fiscal',
		 telefono_fijo='$telefono_fijo',
		 telefono_movil='$telefono_movil',
		 correo='$correo',
		 logo='$logo'
		 WHERE id_empresa='$id_empresa'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($id_empresa)
	{
		$sql="UPDATE empresas SET estado='0' WHERE id_empresa='$id_empresa'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($id_empresa)
	{
		$sql="UPDATE empresas SET estado='1' WHERE id_empresa='$id_empresa'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_empresa)
	{
		$sql="SELECT * FROM empresas WHERE id_empresa='$id_empresa'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * from empresas";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros activos
	public function listarActivos()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function listarActivosVenta()
	{
		$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo,a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo order by iddetalle_ingreso desc limit 0,1) as precio_venta,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);		
	}
	public function select()
	{
		$sql="SELECT * FROM unidad_medida";
		return ejecutarConsulta($sql);		
	}
}

?>