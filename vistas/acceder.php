<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SichaSoft</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/dataTables.bootstrap4.min.css">    
    <link href="../public/datatables/buttons.bootstrap4.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.bootstrap4.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../public/autocomplete/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">
    
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.min.css">

</head>
<body class="hold-transition skin-blue ">
 <div class="content">
 	     <h2 class="page-header text-center">BIENVENIDO: <?php echo $_SESSION['nombre']; ?> </h2>

      <div class="row">
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="../files/logos/<?php echo $_SESSION["logo_empresa"]; ?>" alt="User Avatar" style="height:50px; width:50px">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?php echo $_SESSION["nombre_comercial"] ?></h3>
              <h5 class="widget-user-desc"><?php echo $_SESSION['nombre_empresa']; ?> </h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">RUC: <?php echo $_SESSION["ruc_empresa"]?> <span class="pull-right badge bg-blue"><i class="fa fa-list-ol" aria-hidden="true"></i></span></a></li>
                <li><a href="#">DIRECCION: <span class="pull-right badge bg-aqua"><i class="fa fa-map-marker" aria-hidden="true"></i></span><?php echo $_SESSION["direccion_empresa"]?> </a></li>
                <li><a href="#">TEL/CEL: <?php echo $_SESSION["tel_empresa"] ?> <span class="pull-right badge bg-green"><i class="fa fa-phone" aria-hidden="true"></i></span></a></li>
                <li><a href="../ajax/usuario.php?op=salir" class=""> CERRAR SESION <span class="pull-right badge bg-red"><i class="fa fa-sign-out" aria-hidden="true"></i></span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow text-center">
              
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username text-center">SUCURSALES ASIGNADOS</h3>
        	<h5 class="widget-user-desc ">SELECCIONE UN SUCURSAL PARA ACCEDER PARA USAR EL SISTEMA</h5>
            </div>
            <div class="box-footer no-padding">
              <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado_sucursal" class="table table-striped table-bordered table-condensed table-hover">
                          <thead class="bg-aqua">
                            <th>N°</th>
                            <th>SUCURSAL</th>
                            <th>ACCEDER</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                        
                        </table>
                    </div>
            </div>
          </div>
         
          <!-- /.widget-user -->
        </div>

        <!-- /.col -->
      </div>
 </div>
<?php

require 'footer.php';
?>

<script type="text/javascript" src="scripts/acceder.js"></script>
<?php 

ob_end_flush();
?>
