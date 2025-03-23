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
                          <h1 class="box-title">ACCESOS AL SUCURSAL </h1>
                        <div class="box-tools pull-right">
                      <button class="btn btn-primary btn-flat" id="btnagregar"  data-toggle="modal" data-target=".myModal"><i class="fa fa-plus-circle"></i> NUEVO ACCESO </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                    
                    	<div class="row">
                    	 <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	 	
                    	 <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead class="bg-primary">
                            <th>N°</th>
                            <th>SUCURSAL</th>
                            <th>USUARIO</th>
                            <th>PERFIL</th>
                            <th>OPCIONES</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                           
                        </table>
                       
                       
                    	 </div>
                    	
                    	</div>
                        
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
        <h4 class="modal-title" id="myModalLabel">ASIGNAR SUCURSAL</h4>
      </div>
      <div class="modal-body">
        <form action="" id="formulario">
         	<div class="row">
                    	 <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-6">
                    	 
                            <label>SELECCIONE USUARIO</label>
                            <input type="hidden" name="id_sede_user" id="id_sede_user">
                           <select id="idUsuario" name="idUsuario" class="form-control selectpicker" data-live-search="true" required></select>
                       
                          </div>
                          <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-6">
                            <label>SELECCIONE SUCURSAL</label>
                           <select id="id_sede" name="id_sede" class="form-control selectpicker" data-live-search="true" required></select>
                    	
                          </div>
                          
                    	</div>
           
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
         <button class="btn btn-primary btn-flat" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
      </div>
       </form>
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
<script type="text/javascript" src="scripts/usuario_sede.js"></script>
<?php 
}
ob_end_flush();
?>