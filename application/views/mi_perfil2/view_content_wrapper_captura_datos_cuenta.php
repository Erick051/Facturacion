  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mi perfil
        <small>Actualiza los datos de tu cuenta</small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
              <?php
              if ( isset($titulo) ) {
              ?>
                <div class="<?php echo $tipo_mensaje; ?>">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-exclamation-circle"></i> <?php echo $titulo; ?></h4>
                  <?php echo $mensaje; ?>
                </div>
              <?php
              }
              ?>
        </div>
      </div>

      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="form" method="post" action="<?php echo $url_registra_datos_cuenta; ?>">
              <div class="box-body">
                
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-12">
                    <h4 class="box-title">Datos de la cuenta de usuario</h4>
                  </div>
                </div>
              
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>Login</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="login" name="login" class="form-control" value="<?php echo $pss_usuario->login; ?>" readonly>
                    </div>
                    <div class="col-md-2">
                      <Label>email contacto</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="email_contacto" name="email_contacto" class="form-control" value="<?php echo $pss_usuario->email; ?>">
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>Nombre</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $pss_usuario->nombre; ?>">
                    </div>
                    <div class="col-md-3">
                      <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control" value="<?php echo $pss_usuario->apellido_paterno; ?>">
                    </div>
                    <div class="col-md-3">
                      <input type="text" id="apellido_materno" name="apellido_materno" class="form-control" value="<?php echo $pss_usuario->apellido_materno; ?>">
                    </div>

                  </div>
                </div>
                
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>Pista</label>
                    </div>
                    <div class="col-md-4">
                      <select id="id_pista_recuperar_contrasena" name="id_pista_recuperar_contrasena" class="form-control">
                      <?php
                      foreach ($arr_preguntas_recuperacion as $pregunta) {
                          if ( $pregunta->id_pregunta_recuperacion == $pss_usuario->id_pregunta_recuperacion ) {
                              echo '<option value="'.$pregunta->id_pregunta_recuperacion.'" selected>'.$pregunta->pregunta.'</option>';
                          } else {
                              echo '<option value="'.$pregunta->id_pregunta_recuperacion.'">'.$pregunta->pregunta.'</option>';
                          }
                              
                      }
                      ?>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <Label>Respuesta</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="respuesta_recuperar_contrasena" name="respuesta_recuperar_contrasena" class="form-control" value="<?php echo $pss_usuario->respuesta_recuperar_contrasena; ?>">
                    </div>
                  </div>
                </div>
  

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" value="Guardar" class="btn btn-success"> <a href="<?php echo $url_anterior; ?>" class="btn btn-danger">Cancelar</a>
              </div>
              <!-- /.box-footer-->
            </form>
          </div>
          
          <!-- /.box -->
        </div>



      </div>
      
 

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->