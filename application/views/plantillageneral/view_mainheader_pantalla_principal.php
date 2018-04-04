  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url()."index.php/".URL_PANTALLA_PRINCIPAL; ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>STO</b></span>
      <!-- logo for regular state and mobile devices -->
      <?php
      // si existe titulo configurado      
      if ( $titulo_menu != null && $titulo_menu != "" ) {
         echo '<span class="logo-lg"><b>'.$titulo_menu.'</b></span>';
      } else {
         echo '<span class="logo-lg"><b>STO Consulting</b></span>';    
      }
      ?>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo base_url()."assets/imgcustom/user-2.png"; ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $nombre_usuario; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo base_url()."assets/imgcustom/user-2.png"; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $nombre_usuario; ?>
                  <small>Miembro desde <?php echo $fecha_alta_usuario; ?></small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url()."index.php/".URL_CAMBIAR_MI_CONTRASENA; ?>" class="btn btn-default btn-flat">Cambiar contraseña</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url()."index.php/".URL_CERRAR_SESION; ?>" class="btn btn-default btn-flat">Cerrar sesión</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>