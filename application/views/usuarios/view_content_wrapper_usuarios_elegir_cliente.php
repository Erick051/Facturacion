  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registro de usuario
      </h1>
      <ol class="breadcrumb">
        <li><a href="#">Control de acceso</a></li>
        <li class="active"> Usuarios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Cuenta de usuario</h3>
          <a href="<?php echo $url_anterior; ?>" class="btn btn-warning pull-right"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="#">
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

           <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>Login</label>
               </div>
               <div class="col-md-5">
                 <input type="text" class="form-control" id="login" name="login" value="<?php echo $usuario->login; ?>" readonly>
                 <input type="hidden" id="id_usuario_editado" name="id_usuario_editado" value="<?php echo $usuario->id_usuario_pss; ?>">
               </div>
             </div>
            </div>
            
            <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>Recuperación de contraseña</label>
               </div>
               <div class="col-md-5">
                 <select class="form-control" id="id_pregunta_recuperacion" name="id_pregunta_recuperacion" readonly>
                   <option value="-1">Elige una</option>
                   <?php
                   $selected = "";
                   // listado de preguntas
                   foreach ($arrpreguntas as $pregunta) {
                       if ( $pregunta->id_pregunta_recuperacion == $usuario->id_pregunta_recuperacion ) {
                           $selected = "selected";
                       } else {
                           $selected = "";
                       }
                     echo '<option value="'.$pregunta->id_pregunta_recuperacion.'" '.$selected.'>'.$pregunta->pregunta.'</option>';  
                   }
                   ?>
                 </select>
               </div>
               <div class="col-md-5">
                 <input type="text" class="form-control" id="respuesta_recuperar_contrasena" name="respuesta_recuperar_contrasena" placeholder="Respuesta" value="<?php echo $usuario->respuesta_recuperar_contrasena; ?>" readonly>
               </div>
             </div>
            </div>

            <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>Nombre</label>
               </div>
               <div class="col-md-3">
                 <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre(s)" value="<?php echo $usuario->nombre; ?>" readonly>
               </div>               
               <div class="col-md-3">
                 <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido paterno" value="<?php echo $usuario->apellido_paterno; ?>" readonly>
               </div>               
               <div class="col-md-3">
                 <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Apellido materno" value="<?php echo $usuario->apellido_materno; ?>" readonly>
               </div>               

             </div>
            </div>

            <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>email</label>
               </div>
               <div class="col-md-3">
                 <input type="text" class="form-control" id="email" name="email" placeholder="Dirección email" value="<?php echo $usuario->email; ?>" readonly>
               </div>
             </div>
            </div>

            <!-- relacion de usuario y cliente -->
            <?php
            if ( TIPO_PORTAL == TIPO_PORTAL_CLIENTES || TIPO_PORTAL == TIPO_PORTAL_PSS ) {
            ?>
            <hr>
            <div class="form-group">
              <div class="row">
              
                <div class="col-md-12">
                  
                  <h4>Razones sociales disponibles para relación con cuenta de usuario de portal</h4>
                </div>
              
              </div>
            </div>
            
            <div class="row">
            
              <div class="col-md-12">
                
                <table class="table table-hover table-condensed">
                  <tr>
                    <th>ID Cliente</th>
                    <th>ID ERP</th>
                    <th>RFC</th>
                    <th>Nombre</th>
                    <th>Acción</th>
                  </tr>
                  <?php
                  $conteo = count($arr_clientes_disponibles);

                  if ( $conteo < 1 ) {
                      echo '<tr><td colspan="5">No se tienen registros de cliente relacionados para este usuario</td></tr>';
                  } else {
                      for ($i = 0; $i < $conteo; $i++) {
                          // url para elminar la relacion cliente-usuario especifica
                          $url_agregar_relacion_cliente_usuario_especifico = $url_agregar_relacion_cliente_usuario."/".$arr_clientes_disponibles[$i]->id_cliente;
                          
                          echo '<tr>';
                          echo '<td>'.$arr_clientes_disponibles[$i]->id_cliente.'</td>';
                          echo '<td>'.$arr_clientes_disponibles[$i]->numero_cliente.'</td>';
                          echo '<td>'.$arr_clientes_disponibles[$i]->rfc.'</td>';
                          echo '<td>'.$arr_clientes_disponibles[$i]->cliente.'</td>';
                          echo '<td><a href="'.$url_agregar_relacion_cliente_usuario_especifico.'" class="text-success" title="Relarcionar cliente con cuenta de usuario"><i class="fa fa-plus"></i></a></td>';
                          echo '</tr>';
                      }
                  }
                  
                  ?>
                </table>
              </div>
            </div>

            <?php
            }
            ?>
            
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <a class="btn btn-primary" href="<?php echo $url_anterior; ?>">Aceptar</a>
          </div>
        </form>
      </div>
    

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

