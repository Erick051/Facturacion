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
        <li class="active"><a href="<?php echo base_url()."index.php/principal_ss"; ?>"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        <li><a href="<?php echo base_url()."index.php/captura_datos_fiscales"; ?>"><i class="fa fa-user"></i> <span>Mis datos</span></a></li>
        <li><a href="<?php echo base_url()."index.php/captura_facturacion"; ?>"><i class="fa fa-file-text-o"></i> <span>Facturar ticket</span></a></li>
        <li><a href="<?php echo base_url()."index.php/recuperar_factura_previa"; ?>"><i class="fa fa-newspaper-o"></i> <span>Recuperar facturas previas</span></a></li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>