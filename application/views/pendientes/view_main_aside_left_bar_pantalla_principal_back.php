  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <!--
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      -->



      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENÚ PRINCIPAL</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="<?php echo base_url()."index.php/pantalla_principal"; ?>"><i class="fa fa-link"></i> <span>Inicio</span></a></li>
        <!--li><a href="#"><i class="fa fa-link"></i> <span>Notificaciones</span></a></li-->
        <!-- li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Emisión</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url("index.php/emision_nuevo_comprobante/index"); ?>">Iniciar emision</a></li>
            <li><a href="<?php echo base_url("index.php/emision_nuevo_comprobante/nuevo_comprobante"); ?>">Nuevo comprobante</a></li>
            <li><a href="#">Listado de comprobantes emitidos</a></li>
            <li><a href="#">Cancelación</a></li>
          </ul>
        </li-->
        <li class="treeview">
          <a href="#"><i class="fa fa-gears"></i> <span>Configuración</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li class="treeview">
              <a href="#"> <span>Layouts carga de archivos</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url("index.php/mapeo_csv_nomina12/index"); ?>">CSV Nómina 1.2</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-gears"></i> <span>Tickets</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url("index.php/facturacionTickets/facturacion_tickets/inicio_conciliacion_tickets_facturados"); ?>">Conciliación</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-list-alt "></i> <span>Factura global</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url("index.php/facturacionTickets/facturacion_tickets/factura_global"); ?>">Configuración del proceso</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>