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

if ($_SESSION['ventas']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->

<style type="text/css">
    /* Agregando Inputs */
    .input-group {width: 100%;}
    .input-group-addon { min-width: 180px;text-align: right;}    
    
    .panel-title{
        font-size: 13px;
        font-weight: bold;
    }
    
    .derecha_text { 
        text-align: right; 
        font-size:15;
    }










</style>

      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title text-center " style="color:white" id="lbltitulo"> Lista de ventas </h1>
                        <div class="box-tools pull-right">
                          <h1 class="box-title"> <button class="btn btn-primary" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nueva Venta</button></h1>
                       <input type="hidden" name="idventa" id="idventa">
                        </div>
                        
                    </div>
                    <br>
                    <!-- /.box-header -->
                    <div class="panel-body">

                 
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Registrodo de Control de caja</h3>
                        </div>
                        <div class="panel-body">
                            <form action="" id="formulario">
                                <div class="row">
                                  <div class="form-group col-lg-6 col-md-2 col-sm-6 col-xs-12">
                                    <label>Seleccione:</label>
                                    <select name="cmb_servicio" id="cmb_servicio"  class="form-control selectpicker"  required="">
                                    </select>
      
                                  </div>
                                  <div class="form-group col-lg-6 col-md-2 col-sm-6 col-xs-12">
                                    <label>Fecha:</label>
                                     <input type="date" class="form-control" name="fecha" id="fecha">
      
                                  </div>
                                </div>
                                <div class="row">
                                   <div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
                                    <label>Cantidad/Monto</label>
                                     <input type="text" class="form-control" name="cantidad" id="cantidad">
                                  </div>
                                   <div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
                                    <label>Precio</label>
                                     <input type="text" class="form-control" name="precio" id="precio"> 
                                  </div>
                                   <div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
                                    <label>Total</label>
                                     <input type="text" class="form-control" name="total" id="total">
                                  </div>
                                   <div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
                                    <label>Comisión</label>
                                     <input type="text" class="form-control" name="comision" id="comision">
                                  </div>
                                </div>
                                <div class="row">
                                   <div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-primary" name="guardar" id="btn_guardar">Guardar</button>
                                  </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-lg-12 col-md-2 col-sm-6 col-xs-12 " >
                                  
                                <table class="table table-bordered table-responsive" id="tbl_data">
                                    <thead style="background:#ED4E2A; color:white">
                                      <th>Fecha</th>
                                      <th>Concepto</th>
                                      <th>Cant/Monto</th>
                                      <th>Precio</th>
                                      <th>total</th>
                                     
                                    </thead>
                                    <tbody>

                                    </tbody>
                                  </table>
                                </div>
                                <div class="form-group col-lg-8 col-md-2 col-sm-6 col-xs-12">

                                </div>
                                  <div class="form-group col-lg-4 col-md-2 col-sm-6 col-xs-12">
                                   
                                    <label  id="lblTotal" class="h1 font-weight-bold " style="color:#ED4E2A" >0.0</label>
                                </div>
                                </div>
                            </form>
                        </div>
                        </div>
                           </div>
                    <!-- centro -->

                 


                   
                       
               
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

  <!-- Modal -->
  
  <!-- Fin modal -->
     

  <!-- Modal pdf -->
 

   <!-- Modal pdf -->
  
  
 
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/control_caja.js"></script>

<?php 
}
ob_end_flush();
?>
