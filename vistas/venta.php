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
                          <h1 class="box-title text-center "  id="lbltitulo"> Lista de ventas </h1>
                        <div class="box-tools pull-right">
                          <h1 class="box-title"> <button class="btn btn-primary" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> NUEVA VENTA</button></h1>
                       <input type="hidden" name="idventa" id="idventa">
                        </div>
                        
                    </div>
                    
                    <!-- /.box-header -->
                    <!-- centro -->

                 


                    <div class="panel-body table-responsive" id="listadoregistros">

                    
                    
                        <div class="panel-body">
                           <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead class="bg-primary">
                            
                            <th>FECHA</th>
                            <th>TIPO DOC</th>
                            <th>NUMERO</th>
                            <th>CLIENTE</th>
                            <th>F. PAGO</th>
                            <th>TOTAL</th>
                            <th>ESTADO SUNAT</th>
                           
                            
                          </thead>
                          <tbody>                            
                          </tbody>
                         
                        </table>
                        </div>
                    
                       
                      
                        <div class="panel panel-danger" >
                        <div class="panel-heading"style="background:#ED4E2A; color:white;">RESUMEN DE VENTAS DEL DIA</div>
                        <div class="panel-body">
                          <table  class="table table-striped table-condensed table-bordered" id="tabla_resultados">
                            <thead>
                              <th>FORMA DE PAGO</th>
                              <th>TOTAL</th>
                             
                            </thead>
                            <tbody></tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                       
                    <div class="panel-body" style="height: 100%;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <!--- campo de clientes -->
                            
                          
                          <div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-12"  >
                                <label> PRODUCTO(*):</label>
                                <input type="text" class="form-control" name="cod_prod" id="cod_prod">
                                <div class="input-group">
                              </div>
                          
                          </div>
                          <!--fin del  campo de clientes-->
                         
                          <div class="form-group col-lg-4 col-md-2 col-sm-2 col-xs-12">
                            <label>TIPO DOCUMENTO(*):</label>
                            <select name="tipo_comprobante" id="tipo_comprobante" class="form-control selectpicker" required="">
                             
              
                            </select>
                            
                          </div>
                        
                          <!-- se activara cuando sea necesario
                           <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Tipo Operacion:</label>
                             <select name="tipo_ope" id="tipo_ope" class="form-control selectpicker" required="" disabled > </select>
                          </div>
                          -->
                          
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>SERIE:</label>
                            <input type="text" class="form-control" name="serie_comprobante" id="serie_comprobante" maxlength="7" placeholder="Serie">
                          </div>
                          
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>NUMERO:</label>
                            <input type="text" class="form-control" name="num_comprobante" id="num_comprobante" maxlength="10" placeholder="Número" required="">
                          </div>
                          
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>FECHA EMISION:</label>
                            <input type="date" class="form-control" name="fecha_emision" id="fecha_emision">
                          </div>
                          
                           <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>FECHA VENC.:</label>
                            <input type="date" class="form-control" name="fecha_venc" id="fecha_venc" >
                          </div>
                          
                             <div class="form-group col-lg-8 col-md-12 col-sm-12 col-xs-12">
                              <label>CLIENTE(*):</label>
                              <input type="hidden" name="idcliente" id="idcliente">
                              <div class="input-group">
                                  <input type="text" class="form-control" name="nro_documento" id="nro_documento">
                                  <span class="input-group-btn">
                                  <button class="btn btn-primary" type="button" id="btn_buscar_ruc_dni">
                                  </span><i class="fa fa-search" aria-hidden="true"></i> BUSCAR</button>
                                  </span>
                              </div>
                            
                          </div>
                             <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                           <label>FORMA DE PAGO:</label>
                            <select name="modo_pago" id="modo_pago"  class="form-control selectpicker" onchange="aberi_obs()" required="">
                            </select>
      
                          </div>
                           
                          <!-- se activara cuando sea necesario
                            <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                               <label>Moneda:</label>
                             <select name="id_moneda" id="id_moneda" class="form-control selectpicker" required="" disabled> </select>
                           
                          </div>
                          -->
                          <!-- se activara cuando sea necesario
                           <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                             <label>Tipo Cambio:</label>
                            <input type="text" class="form-control" name="cod_prod" id="cod_prod" disabled>
                          
                          </div>
                          -->

                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive border-1">
                           
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead class="bg-primary">
                                    <th style="width:5%;">CANTIDAD</th>
                                    <th style="width:60%;">PRODUCTO</th>
                                    <th style="width:10%;">PRECIO </th>
                                    <th style="width:10%;">TOTAL </th>
                                    <th style="width:10%;">ELIMINAR</th>
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
                                      <label for="">N° Operación</label>
                                      <input type="text" class="form-control" id="n_op" name="n_op">
                                      <label for="">Observaciones</label>
                                       <input type="text" class="form-control" id="obs" name="obs">
                                    </div>
                                    <div class="col-xs-12 col-md-4 col-lg-6">  

            <div class="panel panel-body" style="border:1px solid #7FB3D5;border-radius:6px;">
                
                <div id="div_descuento_global" class="input-group">        
                    <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">Descuento global: <span class="descuento_global">S/.</span></span>
                    <input type="text" id="descuento_global" name="descuento_global" class="form-control derecha_text">
                      
                  </div>
                
                <div id="div_total_gravada" class="input-group">        
                    <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">Sub Total: <span class="selec_moneda">S/.</span></span>                
                    <input type="text" id="total_gravada" name="total_gravada" class="form-control derecha_text" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;" enabled>
                </div>

                <div id="div_total_inafecta" class="input-group">        
                    <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">Total Ope. Inafecta: <span class="selec_moneda">S/.</span></span>                
                    <input type="text" id="total_inafecta" name="total_inafecta" class="form-control derecha_text" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;">
                </div>

                <div id="div_total_exonerada" class="input-group" >        
                    <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">Total Op. Exonerada: <span class="selec_moneda">S/.</span></span>                
                    <input type="text" id="total_exonerada" name="total_exonerada" class="form-control derecha_text" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;">
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
              
                <div id="div_total_bolsa" class="input-group">        
                    <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">ICBPER: <span class="selec_moneda">S/.</span></span>                
                    <input type="text" id="total_bolsa" name="total_bolsa" class="form-control derecha_text" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;">
                </div>

                <div id="div_PrepaidAmount" class="input-group">                
                    <span class="input-group-addon" style="border:1px solid #ABB2B9;border-right: 0;">Anticipo: <span class="selec_moneda">S/.</span></span>
                    <input type="text" id="PrepaidAmount" name="PrepaidAmount" class="form-control derecha_text" readonly="" style="border:1px solid #ABB2B9;">
                </div>
                
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
  <div class="modal fade" id="mdlGuias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="lbl_title">Guia de Remisión</h4>
        </div>
        <div class="modal-body ">
          <form action="" id="formulario">
         
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
         <button class="btn btn-primary" type="submit" id="btnGuardar_fp"><i class="fa fa-save"></i> Guardar</button>
      </div>
       </form>
          
        </div>
          
      </div>
    </div>
  </div>  
  <!-- Fin modal -->
     <div class="mdlClientes modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">CLIENTES</h4>
        </div>
        <div class="modal-body">
              <p>
                <form action="" id="for_clientes">
                    <input type="hidden" id="idcliente" name="idcliente">

                     <div class="row ">
                      
                         <div class="col-lg-12 col-md-12-col-sm-12">
                           
                                <label id="lbltipodoc">TIPO DOCUMENTO</label>
                                <select id="idTipoDoc" name="idTipoDoc" class="form-control selectpicker" data-live-search="true" required></select>
                             
                         </div>
                      </div>

                       <div class="row ">
                      
                         <div class="col-lg-12 col-md-12-col-sm-12">
                           <label for="" class="form-label fw-bold">RUC/DNI(*):</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="nro_doc" id="nro_doc" required>
                        
                        
                             
                         </div>
                      </div>
                     
                   
                    <div class="row ">
                          <div class="col-lg-12 col-md-12-col-sm-12">
                              <label for="" class="form-label fw-bold">RAZON SOCIAL</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="razon_social" id="razon_social" required>
                        </div>
                      </div>
                    
                      
                     
                  
                        <div class="row ">
                         <div class="col-lg-12 col-md-12-col-sm-12">
                            
                               <label for="" class="form-label fw-bold">DIRECCION</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="direccion" id="direccion" >
                             
                         </div>
                      </div>

                      <div class="row ">
                         <div class="col-lg-6 col-md-12-col-sm-12">
                               <label for="" class="form-label fw-bold">TELEFONO</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="telefono" id="telefono" >
                             
                         </div>
                          <div class="col-lg-6 col-md-12-col-sm-12">
                               <label for="" class="form-label fw-bold">ESTADO SUNAT</label>
                              <input type="text" class="form-control form-control-sm rounded-0 text-uppercase" name="estado_sunat" id="estado_sunat" >
                             
                         </div>
                      </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btn_cerrarModal"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                    <button class="btn btn-primary" type="submit" id="btnGuardar_cl" ><i class="fa fa-save"></i> Guardar</button>
                  </div>
              </form>
            </p>
        </div>
      </div>
    </div>
</div>

  <!-- Modal pdf -->
  <div class="modal fade" id="mdlPDF" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="lbl_title">Imprimir Documento</h4>
        </div>
        <div class="modal-body ">
            <iframe src="" width="100%" height="450px" frameborder="0" scrolling="no"  id="contenedor_pdf"></iframe>
          
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
        
      </div>
       
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
          <h4 class="modal-title" id="lbl_title">Detalle de productos</h4>
        </div>
        <div class="modal-body ">
            <iframe src="" width="850" height="400" frameborder="0" id="cnt_1"></iframe>
            
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-primary" id="modal_guia" ><i class="fa fa-arrow-circle-left"></i> Crear Guia</button>
         <button type="button" class="btn btn-primary" id="imprimir_pdf"><i class="fa fa-file-pdf-o"></i> FORMATO A4</button>
         <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
        </div>
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
<script type="text/javascript" src="scripts/venta.js"></script>

<?php 
}
ob_end_flush();
?>
