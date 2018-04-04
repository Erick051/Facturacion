  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Listado de Usuarios
      </h1>
      <ol class="breadcrumb">
        <li><a href="#">Control de acceso</a></li>
        <li class="active"> Usuarios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de usuarios registrados</h3>
              <a href="<?php echo $url_alta_usuario; ?>" class="btn btn-warning pull-right"><i class="fa fa-plus"></i> Agregar</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <?php
              if ( isset($titulo) ) {
              ?>
                <div class="<?php echo $tipo_mensaje; ?>">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> <?php echo $titulo; ?></h4>
                  <?php echo $mensaje; ?>
                </div>
              <?php
              }
              ?>
            
            
              <div class="table-responsive">
                <table id="listado_usuarios" class="table table-striped table-condensed table-hover">
                  <tbody>
                  <tr>
                    <th>#</th>
                    <th>Login</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>F.Alta</th>
                    <!--th>Ultima sesión</th-->
                    <!--th>Estatus</th-->
                    <th>Perfil</th>
                    <th>Acciones</th>
                  </tr>
                
                  <?php
                  $conteo = 0;
                  foreach ($arrusuarios as $usuario) {
                      $conteo++;
                      echo '<tr>';
                      echo '  <td>'.$conteo.'</td>';
                      echo '  <td>'.$usuario->login.'</td>';
                      echo '  <td>'.$usuario->nombre.' '.$usuario->apellido_paterno.' '.$usuario->apellido_materno.'</td>';
                      echo '  <td>'.$usuario->email.'</td>';
                      echo '  <td>'.$usuario->fecha_alta.'</td>';
                      
                      // se verifica el tipo de usuario
                      $tipo_usuario = "";
                      
                      if ( $usuario->tipo_usuario == 1 ) {
                          $tipo_usuario = "Administrador STO";
                      } else if ( $usuario->tipo_usuario == 2 ) {
                          $tipo_usuario = "Administrador Portal";
                      } else if ( $usuario->tipo_usuario == 3 ) {
                          $tipo_usuario = "Operador portal";
                      } else {
                          $tipo_usuario = "Cliente";
                      }
                      
                      echo '  <td>'.$tipo_usuario.'</td>';
                      //echo '  <td>'.$usuario->fecha_ultima_sesion.'</td>';
                      //echo '  <td>'.$usuario->id_estatus.'</td>';
                      echo '  <td>';
                      $url_detalle_usuario_elegir = $url_detalle_usuario."/".$usuario->id_usuario_pss;
                      $url_editar_usuario_elegir  = $url_editar_usuario."/".$usuario->id_usuario_pss;
                      //echo '    <a href="'.$url_detalle_usuario_elegir.'" class="" title="Ver usuario"><i class="fa fa-search-plus"></i></a>';
                      echo '    <a href="'.$url_editar_usuario_elegir.'" class="" title="Editar usuario"><i class="fa fa-pencil"></i></a>';
                      echo '    <a href="'.$url_detalle_usuario_elegir.'" class="" title="Relacionar usuario con datos de cliente"><i class="fa fa-group"></i></a>';
                      // cambio de estatus de registro
                      $url_cambiar_estado_usuario_id = "";
                      $title_cambiar_estatus = "";
                      $icono_cambiar_estatus = "";
                      if ( $usuario->id_estado_registro == 1 ) {
                          // desbloquear
                          $url_cambiar_estado_usuario_id = $url_cambiar_estado_usuario."/".$usuario->id_usuario_pss."/0";
                          $title_cambiar_estatus = "Desbloquear";
                          $icono_cambiar_estatus = "fa fa-eye";
                      } else {
                          // bloquear
                          $url_cambiar_estado_usuario_id = $url_cambiar_estado_usuario."/".$usuario->id_usuario_pss."/1";
                          $title_cambiar_estatus = "Bloquear";
                          $icono_cambiar_estatus = "fa fa-eye-slash";
                      }
                      //echo '    <a href="'.$url_cambiar_estado_usuario_id.'" class="" title="'.$title_cambiar_estatus.'"><i class="'.$icono_cambiar_estatus.'"></i></a>';
                      echo '</td>';
                      echo '</tr>';
                  }
                  ?>
                 </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

