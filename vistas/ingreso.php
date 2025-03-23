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
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
   
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                    	<br>
                   
                        <div class="box-tools pull-right ">
                          <h1 class="box-title"> <button class="btn btn-primary pull-right" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nueva Compra</button> 

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead class="bg-primary">
                            
                            <th>FECHA</th>
                            <th>DOCUMENTO</th>
                            <th>NUMERO</th>
                            <th>PROVEEDOR</th>
                            <th>RUC</th>
                            <th>TOTAL COMPRA</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                         
                        </table>
                    </div>
                    <div class="panel-body" style="height: 100%;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Proveedor(*):</label>
                             <input type="hidden" name="idproveedor" id="idproveedor">
                            <input type="hidden" name="idingreso" id="idingreso">
                         <div class="input-group">
                            <input type="text" class="form-control" name="nro_documento" id="nro_documento">
                            <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" id="btn_buscar_ruc_dni">
                            </span><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                            </span>
                        </div>
                            
                          </div>
                           
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Fecha(*):</label>
                            <input type="date" class="form-control" name="fecha_hora" id="fecha_hora" required="">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo Comprobante(*):</label>
                            <select name="tipo_comprobante" id="tipo_comprobante" class="form-control selectpicker" required="">
                               <option value="Boleta">Boleta</option>
                               <option value="Factura">Factura</option>
                               <option value="Ticket">Ticket</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Serie:</label>
                            <input type="text" class="form-control text-uppercase" name="serie_comprobante" id="serie_comprobante" maxlength="7" placeholder="Serie">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Número:</label>
                            <input type="text" class="form-control" name="num_comprobante" id="num_comprobante" maxlength="10" placeholder="Número" required="">
                          </div>
    
                          <div class="form-group col-lg-12 col-md-3 col-sm-6 col-xs-12">
                           <div class="row">
                            <div class="col">
                               <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Agregar Producto:</label>
                            <input type="text" class="form-control" name="cod_prod" id="cod_prod">
                          </div>
                          </div>
                          
                            </div>
                          </div>

                          
                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive border-1">
                           
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color:#A9D0F5">
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio </th>
                                    <th>Total </th>
                                    <th>Eliminar</th>
                                </thead>
                              
                                <tbody>
                                  
                                </tbody>
                            </table>
                    
                          </div>
                          <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right ">
                              <div class="">
                              
                                <div class="panel-body">
                                  <div class="row">
                                    
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    
                                    </div>
                                    <div class="col-xs-12 col-md-4 col-lg-6">  

            <div class="panel panel-body" style="border:1px solid #7FB3D5;border-radius:6px;">
                
              
                <div id="div_total_gravada" class="input-group">        
                    <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">Sub Total: <span class="selec_moneda">S/.</span></span>                
                    <input type="text" id="total_gravada" name="total_gravada" class="form-control derecha_text" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;" enabled>
                </div>

               

               

                <div id="div_total_igv" class="input-group">        
                    <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">Total IGV (<span id="valor_igv"></span>18%): <span class="selec_moneda">S/.</span></span>
                    <input type="text" id="total_igv" name="total_igv" class="form-control derecha_text" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;">
                </div>

               <!--  <div id="div_total_gratuita" class="input-group">        
                    <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">Total Ope. Gratuita: <span class="selec_moneda">S/.</span></span>                
                    <input type="text" id="total_gratuita" name="total_gratuita" class="form-control derecha_text" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;">
                </div>
                 -->
                
                <div id="div_total_a_pagar" class="input-group">                
                    <span class="input-group-addon" style="border:1px solid #ABB2B9;border-right: 0;">Pago Total: <span class="selec_moneda">S/.</span></span>                
                    <input type="text" id="total_a_pagar" name="total_a_pagar" class="form-control derecha_text" readonly="" style="border:1px solid #ABB2B9;">
                </div>
            </div>           
        </div>
                                      
                                  </div>
                                      
                                </div>
                              </div>
                             
                            </div>
                             
                           </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
  <div class="modal fade" id="mdlDetalle_Compra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title text-center">DETALLE DE COMPRAS</h4>
        </div>
            <div class="modal-body ">
            
           <div class="panel panel-default">
			  <!-- Default panel contents -->
			  
			  <div class="panel-body table-responsive">
			  
			   <div class="row">
			    <div class="col-lg-10">
			    	<div class="input-group">
			    	 <label>PROVEEDOR</label>
				  <input type="text" class="form-control" id="lblProveedor" readonly>
				 
				</div>
			    </div>
			     <div class="col-lg-2">
			    	<div class="input-group">
			    	 <label>FECHA</label>
				  <input type="text" class="form-control" id="fecha" readonly>
				 
				</div>
			    </div>
			   </div>
			   <div class="row">
			   	<div class="col-lg-4">
				   	<div class="input-group">
				    	 <label>TIPO COMPROBANTE</label>
					  <input type="text" class="form-control" id="documento" readonly>
					</div>
			   	</div>
			   	<div class="col-lg-4">
				   	<div class="input-group">
				    	 <label>SERIE</label>
					  <input type="text" class="form-control" id="serie" readonly>
					</div>
			   	</div>
			   	<div class="col-lg-4">
				   	<div class="input-group">
				    	 <label>NUMERO</label>
					  <input type="text" class="form-control" id="numero" readonly>
					</div>
			   	</div>
			   </div>
				  <br>
				  <table class="table table-striped table-bordered table-condensed table-hover  " id="tbl_detalle">
				<thead class="bg-primary">
					<th class="text-center">CANTIDAD</th>
					<th class="text-center">PRODUCTO</th>
					<th class="text-center">MARCA</th>
					<th class="text-center">PRECIO</th>
					<th class="text-center">IMPORTE</th>
				</thead>
				  </table>
				  <br>
				  <div class="box-tools pull-right ">
						<table class="table">
							<tr>
								<th>SUB TOTAL:</th>
								<td id="sbtotal">S/.500.00</td>
							</tr>
							<tr>
								<th>I.G.V (18%):</th>
								<td id="igv">S/.500.00</td>
							</tr>
							<tr>
								<th>TOTAL:</th>
								<td id="total">S/.500.00</td>
							</tr>
						</table>
                        </div>
			  </div>
			
			  <!-- Table -->
			 
				  
			</div>
		
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->

<!--modal de proveedores-->
  <div class="mdlProveedores modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Nuevo Proveedor</h4>
        </div>
        <div class="modal-body">
              <p>
                <form action="" id="formularioProveedor">
                    <input type="hidden" id="idProveedor" name="idProveedor">
                     <div class="row ">
                      
                         <div class="col-lg-12 col-md-12-col-sm-12">
                           
                                <label id="lbltipodoc">Tipo Documento</label>
                                <select id="idTipoDoc" name="idTipoDoc" class="form-control selectpicker" data-live-search="true" required></select>
                             
                         </div>
                      </div>
                    <div class="row">
                          <div class="col-lg-12 col-md-12-col-sm-12">
                            
                            <label for="" class="form-label fw-bold" id="lbldocumento">Ruc/DNI</label>
                            <input type="text" class="form-control form-control-sm  text-uppercase" name="nro_doc" id="nro_doc" value="-">
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
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="estado_sunat" id="estado_sunat" enabled>
                         </div>
                      </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="cerrarForm()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                    <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                  </div>
              </form>
            </p>
        </div>
      </div>
    </div>
</div>
<!--fin del modal de proveedores-->
<!-- inicio del modal detalle -->

<!-- fin del modal detalle -->
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/ingreso.js"></script>
<?php 
}
ob_end_flush();
?>


