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
                     <button class="btn btn-primary pull-right" id="btnagregar"  onclick="abrirModal(true)"><i class="fa fa-plus-circle"></i> Nuevo Equipo</button>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-bordered table-hover table-sm ">
                          <thead>
                            <th>Equipo</th>
                            <th>Modelo</th>
                            <th>Marca</th>
                            <th>Caracteristicas</th>
                            <th>Accesorios</th>
                            <th>Serie</th>
                            <th>Acciones</th>
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

  <div class="myModal modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nueva Equipo</h4>
      </div>
      <div class="modal-body">
        <form action="" id="formulario">
          <div class="row">
            <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <label>Equipo:</label>
                            <input type="hidden" name="idequipo" id="idequipo">
                            <input type="text" class="form-control text-uppercase" name="nombre" id="nombre" maxlength="50" placeholder="Equipo" required>
            </div>
              <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                           <label>Marca:</label>
                            <select name="marca" id="marca" class="form-control selectpicker" required=""></select>
                </div>
            
          </div>
            <div class="row">
               <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <label>Caracteristicas:</label>
                            <input type="text" class="form-control text-uppercase" name="caracteristicas" id="caracteristicas" maxlength="50" placeholder="Caracteristicas del equipo" required>
                          </div>
            </div>
             <div class="row">
             	
             <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
                            <label>Modelo:</label>
                            <input type="text" class="form-control text-uppercase" name="modelo" id="modelo" maxlength="50" placeholder="Modelo" >
            </div>
            <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
                            <label>Accesorios:</label>
                            
                            <input type="text" class="form-control text-uppercase" name="accesorios" id="accesorios" maxlength="50" placeholder="Accesorios" >
            </div>
            <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
                            <label>Serie:</label>
                           
                            <input type="text" class="form-control text-uppercase" name="serie" id="serie" maxlength="50" placeholder="Serie">
            </div>
           </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="abrirModal(false)"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
         <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
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
<script type="text/javascript" src="scripts/equipos.js"></script>
<?php 
}
ob_end_flush();
?>


