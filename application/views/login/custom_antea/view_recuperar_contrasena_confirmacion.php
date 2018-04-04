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
    if ( isset($mensaje_error) ) {
        ?>
        <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error</h4>
                <?php echo $mensaje_error; ?>
        </div>
        <?php
    }
    ?>

    <div class="row">
      <div class="col-md-12">
        <p>Su contraseña ha sido reestablecida y se ha enviado un correo electrónico con los datos para que pueda hacer inicio de sesión a la cuenta de correo con la que se registró.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <a class="btn btn-primary btn-block" href="<?php echo $url_inicio; ?>">Regresar a pantalla de inicio de sesión</a>
      </div>
    </div>

  </div>
  <!-- /.login-box-body -->
    
    
    
    


</div>
<!-- /.login-box -->

