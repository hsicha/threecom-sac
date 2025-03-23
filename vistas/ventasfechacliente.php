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

if ($_SESSION['consultav']==1)
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
                          <h1 class="box-title">Consulta de Ventas por fecha y cliente</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                    	<div class="row">
                        <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                          <label>Fecha Inicio</label>
                          <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                          <label>Fecha Fin</label>
                          <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" >
                        </div>
                         <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                         <br>
                         <button class="btn btn-success" onclick="listar()">Mostrar</button>
                        </div>
                       </div>
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead class="bg-primary">
                            <th>FECHA E.</th>
                            <th>TIPO COMP.</th>
                            <th>COMPROBANTE</th>
                            <th>CLIENTE</th>
                            <th>TOTAL S/.</th>
                            <th>ESTADO SUNAT</th>
                            <th>DESCARGAS</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          
                        </table>
                        
                    </div>
                    
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
      <!-- Modal pdf -->
  <div class="modal fade" id="mdlPDF" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="lbl_title">Imprimir Documento</h4>
        </div>
        <div class="modal-body ">
            <iframe src="" width="850" height="400" frameborder="0" id="contenedor_pdf"></iframe>
          
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
        
      </div>
       
        </div>
          
      </div>
    </div>
       <!-- Modal pdf -->
  <div class="modal fade" id="mdlPDF1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="lbl_title">Detalle de productos</h4>
        </div>
        <div class="modal-body ">
            <iframe src="" width="850" height="400" frameborder="0" id="cnt_1"></iframe>
            
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-primary" id="modal_guia" ><i class="fa fa-arrow-circle-left"></i> Crear Guia</button>
         <button type="button" class="btn btn-primary" id="imprimir_pdf"><i class="fa fa-file-pdf-o"></i> FORMATO A4</button>
         <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
      
        </div>
        </div>
          
      </div>
    </div>
  <!--Fin-Contenido-->
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/ventasfechacliente.js"></script>
<?php 
}
ob_end_flush();
?>


