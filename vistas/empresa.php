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
if ($_SESSION['acceso']==1)
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
                          <h1 class="box-title text-center">Empresa </h1>
                        <div class="box-tools pull-right">
                        	<button class="btn btn-primary btn-flat" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> NUEVA EMPRESA</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead class="bg-primary">
                            
                            <th>RAZON SOCIAL</th>
                            <th>NOMBRE COMERCIAL</th>
                            <th>RUC</th>
                            <th>DIRECCION</th>
                             <th>LOGO</th>
                             <th>ESTADO</th>
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
   <div class="mdlempresa modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Nuevo Empresa</h4>
        </div>
        <div class="modal-body">
              <p>
                <form action="" id="formulario">
                    <input type="hidden" id="id_empresa" name="id_empresa">

                     <div class="row ">
                      
                         <div class="col-lg-12 col-md-12-col-sm-12">
                           
                                <label id="lbltipodoc">Razon Social(*)</label>
                                <input type="text" class="form-control" name="empresa" id="empresa" rquired  >
                             
                         </div>
                         
                      </div>

                       <div class="row ">
                      
                         <div class="col-lg-12 col-md-12-col-sm-12">
                         <label>Nombre Comercial(*):</label>
                            <input type="text" class="form-control" name="nombre_comercial" id="nombre_comercial">
                         </div>
                      </div>
                     
                   
                    <div class="row ">
                          <div class="col-lg-12 col-md-12-col-sm-12">
                              <label for="" class="form-label fw-bold">Ruc(*)</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="ruc" id="ruc" >
                        </div>
                      </div>
                    
                      
                     
                  
                        <div class="row ">
                         <div class="col-lg-12 col-md-12-col-sm-12">
                            
                               <label for="" class="form-label fw-bold">Domicilio Fiscal</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="domicilio_fiscal" id="domicilio_fiscal" >
                             
                         </div>
                      </div>

                      <div class="row ">
                         <div class="col-lg-6 col-md-12-col-sm-12">
                               <label for="" class="form-label fw-bold">ubigeo</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="ubigeo" id="ubigeo" >
                             
                         </div>
                          <div class="col-lg-6 col-md-12-col-sm-12">
                               <label for="" class="form-label fw-bold">telefono Fijo</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="telefono_fijo" id="telefono_fijo" >
                             
                         </div>
                      </div>

                       <div class="row ">
                         <div class="col-lg-6 col-md-12-col-sm-12">
                               <label for="" class="form-label fw-bold">Telefono_movil</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="telefono_movil" id="telefono_movil" >
                             
                         </div>
                          <div class="col-lg-6 col-md-12-col-sm-12">
                               <label for="" class="form-label fw-bold">Correo </label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="correo" id="correo" >
                             
                         </div>
                      </div>
                    
                       <div class="row ">
                         <div class="col-lg-12 col-md-12-col-sm-12">
                                <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/x-png,image/gif,image/jpeg">
                            <input type="text" name="imagenactual" id="imagenactual">
                            <img src="" width="150px" height="120px" id="imagenmuestra">
                             
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
<script type="text/javascript" src="scripts/empresa.js"></script>
<?php 
}
ob_end_flush();
?>