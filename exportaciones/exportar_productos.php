<?php 
session_start();
require_once __DIR__."/../modelos/Articulo.php";

$idsde=$_SESSION['idsede'];
$articulo=new Articulo();
 header("Content-Type: application/vnd.ms-excel; charset=utf-8");
            header("Content-Disposition: attachment; filename=productos.xls");

?>

<br><br>
<table style="border-1 solid;">
	<thead >
		<tr>
			<th>N</th>
			<th>UN. MEDIDA</th>
			<th>CODIGO PRODUCTO</th>
			<th>PRODUCTO</th>
			<th>MARCA</th>
			<th>STOCK</th>
			<th>PRECIO COSTO</th>
			<th>PRECIO VENTA</th>
		</tr>
</thead>
		<?php 
		$rspta=$articulo->listar($idsde);

		while($mostrar=mysqli_fetch_array($rspta)){
		 ?>

		<tr>
			<td><?php echo $mostrar['nro'] ?></td>
			<td><?php echo $mostrar['UM'] ?></td>
			<td><?php echo $mostrar['codigo_producto'] ?></td>
			<td><?php echo $mostrar['nombre_producto'] ?></td>
			<td><?php echo $mostrar['MARCA'] ?></td>
			<td><?php echo $mostrar['stock'] ?></td>
			<td><?php echo $mostrar['PRECIO_COSTO'] ?></td>
			<td><?php echo $mostrar['PRECIO_VENTA'] ?></td>
		</tr>
	<?php 
	}
	 ?>
	</table>