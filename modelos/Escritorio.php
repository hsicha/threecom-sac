<?php

 function listar_stock_minimo($codigo_almacen)
	{
		$sql="SELECT  a.idarticulo,UPPER(a.codigo_producto)AS codigo_producto,UPPER(a.nombre_producto)AS nombre_producto, m.nombre MARCA, c.nombre CATEGORIA, um.descr_unidad UM, a.precio_costo AS 'PRECIO_COSTO',a.precio_base_venta AS 'PRECIO_VENTA',a.stock AS stock,a.imagen AS imagen, a.condicion AS condicion
			FROM articulo a  INNER JOIN marca m ON a.idmarca=m.idMarca INNER JOIN categoria c ON a.idcategoria=c.idcategoria INNER JOIN unidad_medida um ON a.idunidad_medida=um.idunidad_medida
			WHERE codigo_almacen='$codigo_almacen' AND stock<=10";
		return ejecutarConsulta($sql);		
	}

?>