<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <?php echo $config_portal->titulo_pantalla_principal; ?>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Modificar Cuenta</p>

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
    
    <form action="<?php echo $url_actualiza_usuario; ?>" method="post">
      <div class="form-group has-feedback">
        <label>Nombre del usuario</label>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre(s)" value="<?php echo $arr_user->nombre ?>" readonly>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" placeholder="Apellido paterno" value="<?php echo $arr_user->apellido_paterno ?>" readonly>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" placeholder="Apellido materno" value="<?php echo $arr_user->apellido_materno ?>" readonly>
      </div>

      <div class="form-group has-feedback">
        <label>Numero de Empleado</label>
      </div>
      <div class="form-group has-feedback">
        <input type="text" id="login" name="login" class="form-control" placeholder="Login"  value="<?php echo $arr_user->login ?>" readonly>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <label>Contraseña</label>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="contrasena_n" id="contrasena_n" class="form-control" title="La contraseña debe contener al menos un número, una mayuscula y en total deben ser 12 caracteres." placeholder="Contraseña" maxlength="12" minlength="12" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="confirmar_contrasena_n" id="confirmar_contrasena_n" class="form-control" placeholder="Confirme su contraseña" disabled maxlength="12" minlength="12" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label>Email de contacto</label>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $arr_user->email ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <label>Recuperación de contraseña</label>
      </div>

      <div class="form-group has-feedback">
        <select type="text" name="id_pregunta_recuperacion" id="id_pregunta_recuperacion" class="form-control">
          <option value="-1" selected>Elige una</option>
          <?php
          foreach ($arr_preguntas_recuperacion as $pregunta) {
              echo '<option value="'.$pregunta->id_pregunta_recuperacion.'">'.$pregunta->pregunta.'</option>';
          }
          ?>
        </select>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="respuesta_recuperar_contrasena" id="respuesta_recuperar_contrasena" class="form-control" placeholder="Respuesta a la pregunta">
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button id="btn_actualizar" name="btn_actualizar" disabled type="submit" class="btn btn-primary btn-block">Actualizar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    <a href="<?php echo $url_anterior; ?>" class="text-center">Regresar al inicio</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

