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
                    <div class="box-header with-border ">
                          <h1 class="box-title text-center " style="color:black" id="lbltitulo"> Estado del Orden </h1>
                        <div class="box-tools pull-right">
                          <h1 class="box-title"> <button class="btn btn-primary" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo Orden</button></h1>
                       
                        </div>
                        
                    </div>
                    
                    <!-- /.box-header -->
                    <!-- centro -->

                 


                    <div class="panel-body table-responsive" id="listadoregistros">
                    	<div class="panel panel-primary">
                        <div class="panel-heading">CAMBIAR ESTADO DEL ORDEN</div>
                        	<div class="panel-body">
                        		<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        			<thead class="bg-dark">
			                            <th>Fecha Ingreso</th>
			                            <th>N° Orden</th>
			                            <th>Cliente</th>
			                            <th>Falla </th>
			                            <th>Estado</th>
			                            
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

  <!-- Modal -->
    <div class="mdlestado modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Actualizar Estado</h4>
        </div>
        <div class="modal-body">
              <p>
                <form action="" id="formulario_estado">
                    <input type="hidden" id="idOrden" name="idOrden">

                     <div class="row ">
                      
                         <div class="col-lg-3 col-md-12-col-sm-12">
                        		 <label for="" class="form-label fw-bold">N° Orden(*):</label>
                            	 <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="nro_orden" id="nro_orden" required>
                        
                        	 </div>
                        	 	 <div class="col-lg-3 col-md-12-col-sm-12">
                        		 <label for="" class="form-label fw-bold">Costo Cliente:</label>
                            	 <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="costo_total" id="costo_total" required>
                        
                        	 </div>
                        	  <div class="col-lg-3 col-md-12-col-sm-12">
                        		 <label for="" class="form-label fw-bold">Adelanto:</label>
                            	 <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="adelanto" id="adelanto" required>
                        
                        	 </div>
                        	 
                        	  <div class="col-lg-3 col-md-12-col-sm-12">
                        		 <label for="" class="form-label fw-bold">Diferencia:</label>
                            	 <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="diferencia" id="diferencia" required>
                        
                        	 </div>
                        	 <div class="col-lg-3 col-md-12-col-sm-12">
                        		 <label for="" class="form-label fw-bold">Costo Repuesto:</label>
                            	 <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="costo_repuesto" id="costo_repuesto" required>
                        
                        	 </div>
                      </div>

                       <div class="row ">
                      
                          <div class="col-lg-12 col-md-12-col-sm-12">
                              <label for="" class="form-label fw-bold">Solucion</label>
                              <textarea class="form-control text-uppercase" name="solucion" id="solucion"  rows="3"></textarea>
                        </div>
                      </div>
                      <div class="row ">
                      
                         <div class="col-lg-12 col-md-12-col-sm-12">
                           
                                <label id="lbltipodoc">Seleccione Estado</label>
                                <select id="cbo_estado" name="cbo_estado" class="form-control selectpicker" data-live-search="true" required></select>
                             
                         </div>
                      </div>
                   
                   
                    
                      
                     
                  
                       
                      
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="cancelarform()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                    <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                  </div>
              </form>
            </p>
        </div>
      </div>
    </div>
</div>
  <!-- Fin modal -->
         


    
  
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
  </div>

<div class="modal fade" id="mdlwasap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="lbl_title">Enviar Wahatsapp</h4>
        </div>
        <div class="modal-body ">
           
            <div class="row ">
                         <div class="col-lg-12 col-md-12-col-sm-12">
                               <label for="" class="form-label fw-bold">Celular</label>
                              <div class="input-group">
                                  <input type="text" class="form-control" name="txt_celular" id="txt_celular">
                                  <span class="input-group-btn">
                                  <button class="btn btn-success" type="button" id="btn_enviar_ws">
                                  </span><i class="fa fa-whatsapp" aria-hidden="true"></i>  Enviar</button>
                                  </span>
                              </div>
                      </div>
          
      </div>
      <div class="modal-footer">
        
        
      </div>
       
        </div>
          
      </div>
    </div>
  
    <!--fin del modal wasap -->
  </div>
  <div class="modal fade" id="mdlPDF1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="lbl_title">Imprimir Documento</h4>
        </div>
        <div class="modal-body ">
            <iframe src="" width="850" height="400" frameborder="0" id="cnt_1"></iframe>
          
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
        
      </div>
       
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
<script type="text/javascript" src="scripts/estado_orden.js"></script>

<?php 
}
ob_end_flush();
?>


