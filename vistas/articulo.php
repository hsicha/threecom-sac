<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['almacen']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                    	
                	<h4>PRODUCTOS</h4>
                        <div class="box-tools pull-right">
                         
                          <button class="btn btn-primary pull-left btn-flat" id="btnagregar" data-toggle="modal" data-target=".mdl_articulo"><i class="fa fa-plus-circle"></i> NUEVO PRODUCTO</button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped ">
                          <thead class="bg-primary">
                            <th>N°</th>
                             <th>U. MEDIDA</th>
                            <th>CODIGO</th>
                            <th>DESCRIPCION</th>
                            <th>MARCA</th>
                            <th>STOCK</th>
                            <th>P. COMPRA</th>
                            <th>P. VENTA</th>
                            <th>ACCIONES</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                       
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  <div class="mdl_articulo modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Producto</h4>
      </div>
      <div class="modal-body">
        <p>
        <form action="" id="formulario">
         <input type="hidden" id="idProducto" name="idProducto">
       <div class="row">
          <div class="col-lg-6 col-md-12-col-sm-12">
            <label for="" class="form-label fw-bold">CODIGO SUNAT</label>
            <input type="text" class="form-control form-control-sm  text-uppercase" name="cod_sunat" id="cod_sunat" value="-">

            
         </div>
           <div class="col-lg-6 col-md-12-col-sm-12 fw-bold">
            <label for="" class="form-label fw-bold">CODIGO PRODUCTO</label>
             <input type="text" class="form-control form-control-sm text-upper text-uppercase" name="cod_prod" id="cod_prod" required>
          </div>
       </div>
       <div class="row">
          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <label for="" class="form-label fw-bold">DESCRIPCION PRODUCTO</label>
                          <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="descripcion" id="descripcion" required>
        </div>
	</div>
         <div class="row">
          <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
             <label>CATEGORIA</label>
             <select id="idcategoria" name="idcategoria" class="form-control selectpicker" data-live-search="true" required></select>
		<!---
                  <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/x-png,image/gif,image/jpeg">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                          <img src="" width="150px" height="120px" id="imagenmuestra">
		-->
         </div>
          <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <label>MARCA</label>
                <select id="idmarca" name="idmarca" class="form-control selectpicker" data-live-search="true" required></select>
                
             </div>
            </div>
            <div class="row">
            	<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
            	<label>UND. MEDIDA</label>
        	 <select id="umedida" name="umedida" class="form-control selectpicker" data-live-search="true" required></select>
            	</div>
            	<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
            	<label>PRESENTACION</label>
                <select id="idpresentacion" name="idpresentacion" class="form-control selectpicker" data-live-search="true" required></select>
            		
            	</div>
            </div>
            <div class="row">
            	<div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
            	 <label>STOCK</label>
                <input type="number" class="form-control" name="stock" id="stock" required>
            	</div>
            	<div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12 ">
            	 <label>PRECIO COMPRA</label>
                        <input type="text" class="form-control" name="precio_costo" id="precio_costo" required>
            	</div>
            	<div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
            		 <label>PRECIO VENTA</label>
                          <input type="text" class="form-control" name="pre_venta" id="pre_venta" required>
            	</div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="cerrarForm()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
         <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
      </div>
       </form>
       </p>
    </div>
  </div>
</div>
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/articulo.js"></script>
<?php 
}
ob_end_flush();
?>