<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><?php echo $config_portal->titulo_pantalla_principal; ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicio de sesión</p>
    <p>Su cuenta de usuario es una <strong>cuenta administrativa</strong>. Para poder continuar, teclee su contraseña por favor:<p>
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

    <form action="<?php echo $url_valida_inicio_sesion_contrasena; ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" id="login" name="login" class="form-control" placeholder="Login" value="<?php echo $login; ?>" readonly>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Password">
      </div>
      

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-6">
          <a href="<?php echo $url_anterior; ?>" class="btn btn-default btn-flat">Cancelar</a>
        </div>

        
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-flat pull-right"">Aceptar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

