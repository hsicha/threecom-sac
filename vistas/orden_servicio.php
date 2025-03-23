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
                          <h1 class="box-title text-center " style="color:black" id="lbltitulo"> Lista de Orden de Servicio </h1>
                        <div class="box-tools pull-right">
                          <h1 class="box-title"> <button class="btn btn-primary" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo Orden</button></h1>
                       
                        </div>
                        
                    </div>
                    
                    <!-- /.box-header -->
                    <!-- centro -->

 

                    <div class="panel-body table-responsive" id="listadoregistros">
                    	<div class="panel panel-primary">
                        <div class="panel-heading">LISTA DE ORDENES DE SERVICIO</div>
                        
                        	<div class="panel-body">
                        		
                        	
	                         <div class="row">
	                    
                				 <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12 pull-right">
		                           
		                   <input type="date" class="form-control" name="fecha" id="fecha">
		                          
	                        	</div>
	                        
                 	
                		 </div>
                        		<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        			<thead class="bg-dark">
			                            <th>Fecha Ingreso</th>
			                            <th>N° Orden</th>
			                            <th>Cliente</th>
			                            <th>Equipo</th>
			                            <th>Falla </th>
			                            <th>Accesorios</th>
			                            <th>Total</th>
			                            <th>Adelanto</th>
			                            <th>Diferencia</th>
			                            <th>Opciones</th>
                        			</thead>
			                          <tbody>                            
			                          </tbody>
                         
                        		</table>
                        	</div>
                    	</div>
                    </div>
                       
                    <div class="panel-body" style="height: 100%;" id="formularioregistros">
                       <div class="panel-heading text-center bg-green">DATOS DEL ORDEN</div>
                       <br>
                       <form name="formulario_orden" id="formulario_orden" method="POST">
	                       <div class="row">
		                       	<div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
	                              <label>Cliente(*):</label>
	                              <input type="hidden" name="idcliente" id="idcliente">
	                               <input type="hidden" name="idOrden" id="idOrden">
	                              <div class="input-group">
	                                  <input type="text" class="form-control text-uppercase" name="nro_documento" id="nro_documento">
	                                  <span class="input-group-btn">
	                                  <button class="btn btn-primary" type="button" id="btn_buscar_ruc_dni">
	                                  </span><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
	                                  </span>
	                              </div>
	                            </div>
	                            
	                             <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
		                            <label>Fecha Ingreso:</label>
		                            <input type="date" class="form-control" name="fecha_ingreso" id="fecha_ingreso">
	                          </div>
	                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
	                            <label>Situación(*):</label>
	                            <select name="cbo_situacion" id="cbo_situacion" class="form-control selectpicker" required="">
	                            </select>
                        	</div>
                        	<div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
	                            <label>Número de Orden:</label>
	                            <input type="text" class="form-control" name="num_orden" id="num_orden" maxlength="10" placeholder="Número" required="">
	                        </div>
	                       
                        	
                        	
	                       	
	                       </div>
	                       <div class="panel-heading text-center bg-orange">DATOS DEL EQUIPO</div>
	                      <br>
	                      <div class="row">
	                      	<div class="form-group col-lg-3 col-md-2 col-sm-2 col-xs-12">
	                            <label>Tipo Equipo(*):</label>
	                            <select name="cbo_tipo_eq" id="cbo_tipo_eq" class="form-control selectpicker" required="">
	                            </select>
                        	</div>
                        	<div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
	                             <label>Marca(*):</label>
	                              <input type="hidden" name="idmarca" id="idmarca">
	                              <div class="input-group">
	                                  <input type="text" class="form-control  text-uppercase" name="marca" id="marca">
	                                  <span class="input-group-btn">
	                                  <button class="btn btn-primary" type="button" id="btn_busscar_marca">
	                                  </span><i class="fa fa-search" aria-hidden="true"></i></button>
	                                  </span>
	                              </div>
                          </div>
                          
                          <div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
                            <label>Modelo(*):</label>
                            <input type="text" class="form-control  text-uppercase" name="modelo" id="modelo"  placeholder="Modelo" required="">
                          </div>
                          <div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
                            <label>Accesorios:</label>
                            <input type="text" class="form-control  text-uppercase" name="accesorios" id="accesorios" placeholder="Accesorios" required="">
                          </div>
                        	
	                      </div>
	                      <div class="row">
	                      	<div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                              <input type="hidden" name="idequipo" id="idequipo">
                                <label>Detalle del Equipo(*):</label>
                              <div class="input-group">
                                   <textarea class="form-control text-uppercase" name="det_equipo" id="det_equipo"  rows="0"></textarea>
                              </div>
                          </div>
                           <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                              <label>Falla del Equipo:</label>
                              <textarea class="form-control text-uppercase" name="falla_equipo" id="falla_equipo"  rows="0"></textarea>
                            </div>
                             <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                              <label>Observaciones:</label>
                              <textarea class="form-control text-uppercase" name="observacion" id="observacion"  rows="0"></textarea>
                            </div>
                             
	                      </div>
	                     <div class="row">
	                     <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12 pull-left">
                              <label>Costo Total S/.</label>
                              <input type="text" class="form-control" name="costo_total" id="costo_total" maxlength="10" placeholder="Número" required="">
							</div>
							<div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12 pull-left">
                              <label>Adelanto S/.</label>
                              <input type="text" class="form-control" name="adelanto" id="adelanto" maxlength="10" placeholder="Número" required="">
                          </div>
                           <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12 pull-left">
                              <label>Diferencia S/.</label>
                              <input type="text" class="form-control" name="diferencia" id="diferencia" maxlength="10" placeholder="Número" required="">
                          </div>
                         
	                     </div>
	                    
	                    	 <div class="row">
	                    	 	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
		                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
		                        </div>
	                    	 </div>
             			  
	                     
                       </form>
                       
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

  <!-- Modal -->
  <!-- Fin modal -->
     <div class="mdlClientes modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Ventana de Cliente</h4>
        </div>
        <div class="modal-body">
              <p>
                <form action="" id="formulario_clientes">
                    <input type="hidden" id="idcliente" name="idcliente">

                     <div class="row ">
                      
                         <div class="col-lg-12 col-md-12-col-sm-12">
                           
                                <label id="lbltipodoc">Tipo Documento</label>
                                <select id="idTipoDoc" name="idTipoDoc" class="form-control selectpicker" data-live-search="true" required></select>
                             
                         </div>
                      </div>

                       <div class="row ">
                      
                         <div class="col-lg-12 col-md-12-col-sm-12">
                           <label for="" class="form-label fw-bold">Ruc/DNI(*):</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="nro_doc" id="nro_doc" required>
                        
                        
                             
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
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="direccion" id="direccion" >
                             
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
                    <button type="button" class="btn btn-danger" onclick="cancelarform()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                    <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                  </div>
              </form>
            </p>
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
    <!--modal envio de wasap-->
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

  <div class="mdlMarca modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nueva Marca</h4>
      </div>
      <div class="modal-body">
        <form action="" id="formulario_Marca">
          <div class="row">
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Nombre:</label>
                            <input type="hidden" name="idmarca" id="idmarca">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre" required>
                          </div>
          </div>
            <div class="row">
               <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <label>Descripcion:</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="50" placeholder="Nombre" >
                          </div>
            </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
         <button class="btn btn-primary" type="submit" id="btnGuardar_Marca"><i class="fa fa-save"></i> Guardar</button>
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
<script type="text/javascript" src="scripts/orden_servicio.js"></script>

<?php 
}
ob_end_flush();
?>


