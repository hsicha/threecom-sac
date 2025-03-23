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
                          <h1 class="box-title">SUCURSALES </h1>
                        <div class="box-tools pull-right">
                        	<button class="btn btn-primary btn-flat" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> NUEVO SUCURSAL</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead class="bg-primary">
                            <th>N°</th>
                            <th>RAZON SOCIAL</th>
                            <th>DIRECCION</th>
                            <th>LOCAL COMERCIAL</th>
                            <th>TEL/CELULAR</th>
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
          <h4 class="modal-title" id="myModalLabel">REGISTRAR SUCURSAL</h4>
        </div>
        <div class="modal-body">
              <p>
                <form action="" id="formulario">
                    <input type="hidden" id="idsede" name="idsede">

                     <div class="row ">
                      
                         <div class="col-lg-12 col-md-12-col-sm-12">
                           
                                <label id="lbltipodoc">DIRECCION(*)</label>
                                <input type="text" class="form-control  text-uppercase" name="direccion" id="direccion" rquired  >
                             
                         </div>
                         
                      </div>

                       <div class="row ">
                      
                         <div class="col-lg-12 col-md-12-col-sm-12">
                         <label>DISTRITO - PROVINCIA - DEPARTAMENTO(*):</label>
                          <select id="id_ubigeo" name="id_ubigeo" class="form-control selectpicker"  data-live-search="true" required></select>
                         </div>
                      </div>
                     
                   
                    <div class="row ">
                          <div class="col-lg-12 col-md-12-col-sm-12">
                              <label for="" class="form-label fw-bold"> UBIGEO(*)</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="ubigeo" id="ubigeo" >
                        </div>
                      </div>
                    
                      
                     
                  
                        <div class="row ">
                         <div class="col-lg-12 col-md-12-col-sm-12">
                            
                               <label for="" class="form-label fw-bold">RAZON SOCIAL</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="nombre_sede" id="nombre_sede" >
                             
                         </div>
                      </div>

                      <div class="row ">
                         <div class="col-lg-6 col-md-12-col-sm-12">
                               <label for="" class="form-label fw-bold">TEL./CELULAR</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="tel_celular" id="tel_celular" >
                             
                         </div>
                           <div class="col-lg-6 col-md-12-col-sm-12">
                               <label for="" class="form-label fw-bold">ANEXOS</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="anexos" id="anexos" >
                             
                         </div>
                        
                         
                      </div>
                     
                       

                     
                         <!--
                          <div class="col-lg-6 col-md-12-col-sm-12">
                               <label for="" class="form-label fw-bold">Correo </label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="correo" id="correo" >
                             
                         </div>
                      </div>
                    
                       <div class="row ">
                         <div class="col-lg-12 col-md-12-col-sm-12">
                                <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/x-png,image/gif,image/jpeg">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" width="150px" height="120px" id="imagenmuestra">
                             
                         </div>
                         
                      </div>
                        <div class="row ">
                         <div class="col-lg-6 col-md-12-col-sm-12">
                               <label for="" class="form-label fw-bold">Usuario Secundario</label>
                             <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="usuario_secundario" id="usuario_secundario" >
                         </div>
                          <div class="col-lg-6 col-md-12-col-sm-12">
                               <label for="" class="form-label fw-bold">Password Secundario</label>
                             <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="password_secundario" id="password_secundario" >
                             
                         </div>
                      </div>
                        !-->
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
<script type="text/javascript" src="scripts/sedes.js"></script>
<?php 
}
ob_end_flush();
?>