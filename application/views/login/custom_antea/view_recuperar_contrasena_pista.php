<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <?php echo $config_portal->titulo_pantalla_principal; ?>
  </div>
  <!-- /.login-logo -->

    
    
  <div class="login-box-body">
    <p class="login-box-msg">Recuperar contraseña</p>
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

    <form action="<?php echo $url_valida_recuperacion_contrasena; ?>" method="post">
      <input type="hidden" name="id_usuario" value="<?php echo $usuario->id_usuario_pss; ?>" />
      <div class="form-group has-feedback">
        <label><?php echo $pregunta_recuperacion->pregunta; ?></label>
        <input type="text" id="respuesta" name="respuesta" class="form-control" placeholder="Teclee la respuesta a su pregunta">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block">Aceptar</button>
        </div>
        <div class="col-xs-6 pull-right">
          <a href="<?php echo $url_inicio; ?>">Regresar al inicio</a>
        </div>
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
    
    
    
    


</div>
<!-- /.login-box -->

