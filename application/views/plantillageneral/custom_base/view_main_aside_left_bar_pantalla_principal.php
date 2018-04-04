  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- search form (Optional) -->
      <!--form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form-->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">Menú</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="<?php echo base_url()."index.php/".URL_PANTALLA_PRINCIPAL; ?>"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        <li><a href="<?php echo base_url()."index.php/".URL_MI_PERFIL; ?>"><i class="fa fa-envelope-o"></i> <span>Mi perfil</span></a></li>
<?php
/*
        <li><a href="<?php echo base_url()."index.php/".URL_MIS_COMPROBANTES_PSS; ?>"><i class="fa fa-list-alt"></i> <span>Mis comprobantes autofactura</span></a></li>
        <li><a href="<?php echo base_url()."index.php/".URL_MIS_COMPROBANTES_BOVEDA; ?>"><i class="fa fa-list-alt"></i> <span>Mis comprobantes boveda</span></a></li>
  */?>
        <?php
        $query_tipo_user = $this->db->query("SELECT tipo_usuario FROM pss_usuario WHERE id_usuario_pss = ".$this->session->userdata("id_usuario"));
        $tipo_usuario =  $query_tipo_user->row();
        $tipo_usuario = $tipo_usuario->tipo_usuario;
        // portal autofactura si tiene facturar tickets
        if ( TIPO_PORTAL == TIPO_PORTAL_PSS ) {
            ?>
            <li><a href="<?php echo base_url()."index.php/".URL_FACTURAR; ?>"><i class="fa fa-ticket"></i> <span>Facturar ticket</span></a></li>
            <?php
        }
        if ( intval($tipo_usuario) < 3 && intval($tipo_usuario)!= null) {
            ?>
            <li><a href="<?php echo base_url().'index.php/modificar_ticket'; ?>"><i class="fa fa-ticket"></i> <span>Modificar ticket</span></a></li>
            <?php
        }
        // si el usuario es el administrador
        /*if ( TIPO_PORTAL == TIPO_PORTAL_PSS ) {//$this->session->userdata("id_usuario") == 1 ) {
            ?>
            <li><a href="<?php echo base_url().'index.php/modificar_ticket'; ?>"><i class="fa fa-ticket"></i> <span>Modificar ticket</span></a></li>
            <?php
        } */
        if ( TIPO_PORTAL == TIPO_PORTAL_PSS ) {
            ?>
            <li><a href="<?php echo base_url()."index.php/".URL_MIS_COMPROBANTES_PSS; ?>"><i class="fa fa-list-alt"></i> <span>Mis comprobantes</span></a></li>
            <?php
        }
        // portal clientes solo puede ver comprobantes
        if ( TIPO_PORTAL == TIPO_PORTAL_CLIENTES ) {
            ?>
            <li><a href="<?php echo base_url()."index.php/".URL_MIS_COMPROBANTES_PSS; ?>"><i class="fa fa-list-alt"></i> <span>Mis comprobantes</span></a></li>
            <?php
        }
        // portal boveda solo puede consultar los comprobantes
        if ( TIPO_PORTAL == TIPO_PORTAL_BOVEDA ) {
            ?>
            <li><a href="<?php echo base_url()."index.php/".URL_MIS_COMPROBANTES_BOVEDA; ?>"><i class="fa fa-list-alt"></i> <span>Mis comprobantes</span></a></li>
            <?php
        }

        // si el usuario es el administrador
        if ( $tipo_usuario < 3  && intval($tipo_usuario)!= null) {
            ?>
            <li><a href="<?php echo base_url().'index.php/config_portal'; ?>"><i class="fa fa-gears"></i> <span>Configurar portal</span></a></li>
            <li><a href="<?php echo base_url().'index.php/usuarios'; ?>"><i class="fa fa-users"></i> <span>Usuarios</span></a></li>
            <li><a href="<?php echo base_url().'index.php/liberarTicketAICM'; ?>"><i class="fa fa-ticket"></i> <span>Liberar Ticket</span></a></li>
            <?php
        }
        ?>

        <?php
        /*
        // =============================================== OPCIONES DINAMICAS DE MENU =====================================================
        $ultimo_grupo = "";
        $grupo_abierto = false;



        foreach ($arrmenu as $menu ) {

          // si el grupo esta abierto
          if ( $grupo_abierto ) {
              // se verifica si la clave que se tiene coincide con el del grupo abierto
              if ( substr($menu->clave_seccion,0,3) != $ultimo_grupo ) {
                  // la opcion corresponde con otro grupo o es una seccion fuera
                  echo '          </ul>
                                 </li>';

                  // se cierra el grupo
                  $grupo_abierto = false;
              }
          }

          if ($menu->es_grupo == 1) {

              // se abre grupo
              $ultimo_grupo = $menu->clave_seccion;
              $grupo_abierto = true;

              echo '        <li class="treeview">
                              <a href="#"><i class="fa '.$menu->icono.'"></i> <span>'.$menu->d_menu.'</span>
                                <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                                </span>
                              </a>
                              <ul class="treeview-menu">';

          } else {

              // opcion de menu
              if ( $menu->icono == null ) {
                  $icono = null;
              } else {
                  $icono = '<i class="fa '.$menu->icono.'"></i> ';
              }
              echo '<li><a href="'.base_url()."index.php/".$menu->ruta.'">'.$icono.'<span>'.$menu->d_menu.'</span></a></li>';

          }
        }
        */
        ?>
        <?php
        /*
        <li><a href="<?php echo base_url()."index.php/".URL_BITACORA; ?>"><i class="fa fa-book"></i> <span>Bitácora</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-key"></i> <span>Consultas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url()."index.php/".URL_CONSULTA_COMPROBANTES; ?>">Comprobantes</a></li>
            <li><a href="<?php echo base_url()."index.php/".URL_CONSULTA_REPORTES; ?>">Reportes emitidos</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-key"></i> <span>Acceso</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url("index.php/usuarios"); ?>">Usuarios</a></li>
            <li><a href="<?php echo base_url("index.php/perfiles"); ?>">Perfiles</a></li>
          </ul>
        </li>
        */
        ?>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
