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
if ($_SESSION['tipodoc']==1)
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
                          <h1 class="box-title">TIPO DE DOCUEMNTOS  </h1>
                          
                          
                          
                        <div class="box-tools pull-right">
                        	<button class="btn btn-primary btn-flat" id="btnagregar" data-toggle="modal" data-target=".myModal"><i class="fa fa-plus-circle"></i> NUEVO NUEVO TIPO DOCUMENTO</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                     
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead class="bg-primary">
                            <th>N°</th>
                            <th>TIPO DOCUMENTO</th>
                            <th>SERIE</th>
                            <th>NUMERO</th>
                            <th>OPCIONES</th>
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
  <div class="myModal modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">TIPO DOCUMENTO</h4>
      </div>
      <div class="modal-body">
        <p>
        <form action="" id="formulario">
         <input type="hidden" id="idtipodocumento" name="idtipodocumento">
         
       <div class="row">
          <div class="col-lg-12 col-md-12-col-sm-12">
                 <label>SELECCIONE DOCUMENTO</label>
              <select id="codigo_doc" name="codigo_doc" class="form-control selectpicker"  data-live-search="false" required></select>
             
             </select>

            </div>
            </div>
            <div class="row">
            <div class="col-lg-6 col-md-12-col-sm-12">
                 <label for="" class="form-label fw-bold">SERIE</label>
                <input type="text" class="form-control form-control-sm  text-uppercase" name="serie" id="serie">
            </div>

        
             <div class="col-lg-6 col-md-12-col-sm-12">
                 <label for="" class="form-label fw-bold">NUMERACION</label>
                <input type="text" class="form-control form-control-sm  text-uppercase" name="numeracion" id="numeracion" >
            </div>
         </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="mostrarform()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
<script type="text/javascript" src="scripts/tipodoc.js"></script>
<?php 
}
ob_end_flush();
?>