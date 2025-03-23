<?php
if (strlen(session_id()) < 1) 
  session_start();
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
  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header ">

        <!-- Logo -->
        <a href="escritorio.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SF</b>Sichasost</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SichaSoft</b></span>
          
        </a>
 
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
        
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            
            <ul class="nav navbar-nav">
           
            
         
            
              <!-- Messages: style can be found in dropdown.less-->
             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
              
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/logos/<?php echo $_SESSION['logo']; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../files/logos/<?php echo $_SESSION['logo']; ?>" class="img-circle" alt="User Image">
                    <p>
                        <span>SEDE: <?=$_SESSION['sede']?></span><br>
                      
                    </p>
                    
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="../vistas/acceder.php" class="btn btn-primary btn-flat">Cambio Sucursal</a>
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-primary btn-flat">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            <?php 
            if ($_SESSION['escritorio']==1)
            {
              echo '<li id="mEscritorio">
              <a href="escritorio.php">
                <i class="fa fa-tasks"></i> <span>Escritorio</span>
              </a>
            </li>';
            }
            ?>

	  <?php 
            if ($_SESSION['acceso']==1)
            {
              echo '<li id="mAcceso" class="treeview">
              <a href="#">
                <i class="fa fa-cog"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li id="lPerfil"><a href="perfil.php"><i class="fa fa-circle-o"></i> Perfiles</a></li>
                <li id="lUsuarios"><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li id="lPermisos"><a href="usuario_sede.php"><i class="fa fa-circle-o"></i> Usuario Sede</a></li>
                 <li id="lEempresa"><a href="empresa.php"><i class="fa fa-circle-o"></i> Empresa</a></li>
                 <li id="lSedes"><a href="sedes.php"><i class="fa fa-circle-o"></i> Sedes</a></li>
              </ul>
            </li>';
            }
            ?>
            <?php 
            if ($_SESSION['almacen']==1)
            {
              echo '<li id="mAlmacen" class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li id="lArticulos"><a href="articulo.php"><i class="fa fa-circle-o"></i> Artículos</a></li>
                <li id="lCategorias"><a href="categoria.php"><i class="fa fa-circle-o"></i> Categorías</a></li>
                 <li id="lMarca"><a href="marca.php"><i class="fa fa-circle-o"></i> Marca</a></li>
                   <li id="lPresentacion"><a href="presentacion.php"><i class="fa fa-circle-o"></i> Presentacion</a></li>
                  
                 </ul>
            </li>';
            }
            ?>

            <?php 
            if ($_SESSION['compras']==1)
            {
              echo '<li id="mCompras" class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li id="lIngresos"><a href="ingreso.php"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                <li id="lProveedores"><a href="proveedor.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>
              </ul>
            </li>';
            }
            ?>
            <?php

            if($_SESSION['tipodoc']==1){
          echo   ' <li id="ltipodoc"> <a href="tipodoc.php">
                <i class="fa fa-file-text" aria-hidden="true"></i> <span>Tipo Documento</span>
              </a>
            </li>';
            
            }
            ?>
            <?php 
            if ($_SESSION['control']==1)
            {
              echo '<li id="mVentas" class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Control Caja</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li id="lVentas"><a href="control_caja.php"><i class="fa fa-circle-o"></i> Control</a></li>
              </ul>
            </li>';
            }
            ?>
             <?php 
            if ($_SESSION['ventas']==1)
            {
              echo '<li id="mVentas" class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li id="lVentas"><a href="venta.php"><i class="fa fa-circle-o"></i> Ventas</a></li>
                <li id="lClientes"><a href="cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li id="lNotaCerdito"><a href="nota_credito.php"><i class="fa fa-circle-o"></i> Nota de Crédito</a></li>
              </ul>
            </li>';
            }
            ?>

             <?php 
            if ($_SESSION['orden_serv']==1)
            {
              echo '<li id="mOrden" class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Orden Servicio</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li id="lOrden"><a href="orden_servicio.php"><i class="fa fa-circle-o"></i>Nuevo</a></li>
               <li id="lMarca"><a href="estado_orden.php"><i class="fa fa-circle-o"></i> Estado</a></li>
              <li id="lOrden"><a href="tipo_servicio.php"><i class="fa fa-circle-o"></i>Consultas</a></li>
                <li id="lRt"><a href="rt.php"><i class="fa fa-circle-o"></i>Nuevo RT</a></li>
              </ul>
            </li>';
            }
            ?>
                        
            

            <?php 
            if ($_SESSION['consultac']==1)
            {
              echo '<li id="mConsultaC" class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Compras</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li id="lConsulasC"><a href="comprasfecha.php"><i class="fa fa-circle-o"></i> Consulta Compras</a></li>                
              </ul>
            </li>';
            }
            ?>

             <?php 
            if ($_SESSION['consultav']==1)
            {
              echo '<li id="mConsultaV" class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Ventas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li id="lConsulasV"><a href="ventasfechacliente.php"><i class="fa fa-circle-o"></i> Consulta Ventas</a></li>                
              </ul>
            </li>';
            }
            ?>

            <li>
              <a href="ayuda.php">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="acerca.php">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
