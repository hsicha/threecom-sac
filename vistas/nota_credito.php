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


</style>
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title text-center "  id="lbltitulo">CREAR NOTA DE CREDITO </h1>
                      
                    </div>
                    
                    <!-- /.box-header -->
                    <!-- centro -->


                       
                       <div class="panel-body" style="height: 100%;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <!--- campo de clientes -->
                            
                         <div class="panel panel-primary ">
                          <div class="panel-heading ">Datos del Documento</div>
                          <div class="panel-body">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                 <label>Seleccione Tipo Documento</label>
                                  <select name="tipo_comprobante" id="tipo_comprobante" class="form-control selectpicker" required="">
                                </select>

                          
                          
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Serie:</label>
                            <input type="text" class="form-control" readonly name="serie_comprobante" id="serie_comprobante" maxlength="7" placeholder="Serie">
                          </div>
                          <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
                              <label>Ingrese Numero(*):</label>
                              
                              <div class="input-group">
                                  <input type="text" class="form-control" name="nro_serie" id="nro_serie">
                                  <span class="input-group-btn">
                                  <button class="btn btn-primary" type="button" id="btn_buscar_venta">
                                  </span><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                                  </span>
                              </div>
                            
                          </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <label>Tipo documento(*):</label>
                                <input type="text" class="form-control" name="nombre_tipo_doc" id="nombre_tipo_doc" readonly>
                                <div class="input-group">
                              </div>
                          
                          </div>
                          
                          
                          <div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
                            <label>Serie:</label>
                            <input type="text" class="form-control"  name="serie_comprobante_1" id="serie_comprobante_1"  maxlength="7" placeholder="Serie" readonly>
                          </div>
                          
                       
                          
                          <div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
                            <label>Numero:</label>
                            <input type="text" class="form-control" name="numero_serie" id="numero_serie" readonly>
                          </div>
                          
                           <div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
                            <label>Fecha Emision.:</label>
                            <input type="date" class="form-control" name="fecha_venc" id="fecha_venc" readonly >
                          </div>
                          
                             <div class="form-group col-lg-2 col-md-12 col-sm-12 col-xs-12">
                              <label>DNI/RUC Cliente(*):</label>
                             
                              <div class="input-group">
                                  <input type="text" class="form-control" name="nro_documento" id="nro_documento" readonly>
                                 
                              </div>

                              
                            
                          </div>
                           <div class="form-group col-lg-6 col-md-2 col-sm-6 col-xs-12">
                           
                            <label>Cliente:</label>
                             <input type="hidden" id="idcliente" name="idcliente">
                            <input type="text" class="form-control" name="razon_social" id="razon_social" readonly>
                          </div>

                           <div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
                            <label>Dirección.:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" readonly >
                          </div>
                          
                            <div class="form-group col-lg-4 col-md-2 col-sm-6 col-xs-12">
                            <label>Sub Total:</label>
                            <input type="text" class="form-control" name="sub_total" id="sub_total" readonly>
                          </div>
                          <div class="form-group col-lg-4 col-md-2 col-sm-6 col-xs-12">
                            <label>IGV:</label>
                            <input type="text" class="form-control" name="igv" id="igv" readonly>
                          </div>
                          <div class="form-group col-lg-4 col-md-2 col-sm-6 col-xs-12">
                            <label>TOTAL:</label>
                            <input type="text" class="form-control" name="total" id="total" readonly>
                          </div>
                          </div>
                    
                          
                        </div>
                          
                         
                          
                        
      <div class="panel panel-primary">
        <div class="panel-heading">Detalle de la Venta</div>
        <div class="panel-body">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive border-1">
                          

                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead class="bg-info">
                                    <th  style="width:120px">Producto</th>
                                    <th  style="width:5px">Cantidad</th>
                                    <th  style="width:5px">Precio </th>
                                    <th  style="width:5px">Total </th>
                                    
                                </thead>
                              
                                <tbody>
                                  
                                </tbody>
                            </table>
                    
                          </div>
</div>
                         
                          
                       
                           <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right ">
                              <div class="">
                              
                                <div class="panel-body">
                                  <div class="row">
                                    
                                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                      <label for="">Comprobante</label>
                                      <select name="t_comprobante" id="t_comprobante" class="form-control selectpicker" required="">
                                      
                                      </select>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-lg-6">  
                                       <label>Serie:</label>
                                        <input type="text" class="form-control" name="serie_nota" id="serie_nota">
                                     </div>
                                   <div class="col-lg-3 col-md-4 col-lg-6">  
                                       <label>Numero:</label>
                                        <input type="text" class="form-control" name="numero_nota" id="numero_nota">
                                     </div>
                                      <div class="col-lg-3 col-md-4 col-lg-6">  
                                       <label>Fecha Emision:</label>
                                        <input type="date" class="form-control" name="fecha_emision_nota" id="fecha_emision_nota">
                                     </div>
                                      
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                      <label for="">Motivo de la Nota</label>
                                      <select name="tipo_ncredito" id="tipo_ncredito" class="form-control selectpicker" required="">
                                      </select>
                                    </div>
                                    <br>
                                     <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                                      <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                                    </div>
                                  </div>
                             
                        
                                      
                                </div>
                         
                              </div>
                             
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
   
  <!-- Modal pdf -->
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

<script type="text/javascript" src="scripts/nota_credito.js"></script>
<?php 
}
ob_end_flush();
?>
