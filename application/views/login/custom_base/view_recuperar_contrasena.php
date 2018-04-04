<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <?php echo $config_portal->titulo_pantalla_principal; ?>
  </div>
  <!-- /.login-logo -->

    
    
  <div class="login-box-body">
    <p class="login-box-msg">Recuperar contraseña</p>
    <?php
    // si se tiene un error al inicio de la sesion
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

    <form action="<?php echo $url_valida_usuario_recuperar_contrasena; ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" id="login_email" name="login_email" class="form-control" placeholder="Teclee su login o correo electrónico principal">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" class="btn btn-success btn-block">Aceptar</button>
        </div>
        <div class="col-xs-6 pull-right">
          <a href="<?php echo $url_inicio; ?>" class="btn btn-warning btn-block">Regresar al inicio</a>
        </div>
        <!-- /.col -->
      </div>
    </form>

    

  </div>
  <!-- /.login-box-body -->
    
    
    
    


</div>
<!-- /.login-box -->

