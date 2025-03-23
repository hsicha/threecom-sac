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
if ($_SESSION['compras']==1)
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
                    <div class="box-header with-border ">
	                          <h1 class="box-title">PROVEEDORES  </h1>
                        <div class="box-tools pull-right">
                        	<button class="btn btn-primary rounded-0" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> NUEVO PROVEEDOR</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover table-responsive">
                          <thead class="bg-primary">
                           
                            <th> DOCUMENTO</th>
                            <th>N° DOC</th>
                            <th>RAZON SOCIAL</th>
                            <th>DIRECCION</th>
                            <th>TELEFONO</th>
                            <th> SUNAT</th>
                             <th>OPCIONES</th>
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
  <!--Fin-Contenido-->
   <div class="mdlProveedores modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center" id="myModalLabel">Nuevo Proveedor</h4>
        </div>
        <div class="modal-body">
              <p>
                <form action="" id="formulario">
                    <input type="hidden" id="idProveedor" name="idProveedor">

                     <div class="row ">
                      
                         <div class="col-lg-12 col-md-12-col-sm-12">
                           
                                <label id="lbltipodoc">Tipo Documento</label>
                                <select id="idTipoDoc" name="idTipoDoc" class="form-control selectpicker" data-live-search="true" required></select>
                             
                         </div>
                      </div>

                       <div class="row ">
                      
                         <div class="col-lg-12 col-md-12-col-sm-12">
                         <label>Ruc/DNI(*):</label>
                         <div class="input-group">
                            <input type="text" class="form-control" name="nro_doc" id="nro_doc">
                            <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" id="btn_buscar_ruc_dni">
                            </span><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                            </span>
                        </div>
                             
                         </div>
                      </div>
                     
                   
                    <div class="row ">
                          <div class="col-lg-12 col-md-12-col-sm-12">
                              <label for="" class="form-label fw-bold">Razon Social</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="razon_social" id="razon_social" required>
                        </div>
                      </div>
                    
                      
                     
                  
                        <div class="row ">
                         <div class="col-lg-12 col-md-12-col-sm-12">
                            
                               <label for="" class="form-label fw-bold">Dirección</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="direccion" id="direccion" required>
                             
                         </div>
                      </div>

                      <div class="row ">
                         <div class="col-lg-6 col-md-12-col-sm-12">
                               <label for="" class="form-label fw-bold">Teléfono</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="telefono" id="telefono" >
                             
                         </div>
                          <div class="col-lg-6 col-md-12-col-sm-12">
                               <label for="" class="form-label fw-bold">Estado Sunat</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="estado_sunat" id="estado_sunat" >
                             
                         </div>
                      </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="mostrarform(false)"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                    <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                  </div>
              </form>
            </p>
        </div>
      </div>
    </div>
</div>
<!--fin del modal de proveedores-->
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="scripts/proveedor.js"></script>
<?php 
}
ob_end_flush();
?>