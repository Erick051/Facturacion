<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><?php echo $config_portal->titulo_pantalla_principal; ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicio de sesión</p>
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

    <form action="<?php echo $url_valida_inicio_sesion; ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" id="login" name="login" class="form-control" placeholder="Login">
      </div>
      <?php
      $display_none = "";
      if ( $config_portal->usar_contrasena == "3" ) {
        $display_none = "style='display:none'";
      }
      ?>
      <div class="form-group has-feedback">
        <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Password" <?php echo $display_none; ?>>
      </div>
      
      <?php
      
      echo '<div class="row">';
      echo '  <div class="col-xs-12">';
      // si se activo el captcha
      if ( $config_portal->activar_captcha == 1 ) {
          echo '<input type="text" name="captcha" value="Captcha aqui" id="captcha">';
      } else {
          echo '<input type="hidden" name="captcha" value="CAPTCHANA" id="captcha">';
      }
      echo '  </div>';
      echo '</div>';
      ?>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Recordarme
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Aceptar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br>
    <div class="row">
       <div class="col-md-6">
          <?php 
          // si el autodesbloqueo esta activo
          if ( $config_portal->activar_autodesbloqueo == 1 ) {
              ?>
          <span><a href="<?php echo $url_recuperar_contrasena; ?>">Olvidé mi contraseña</a></span>
          <?php
          }// autodesbloqueo
          ?>
       </div>
       <div class="col-md-6 pull-right">
         <?php
         // si el autoregistro esta activo
         if ( $config_portal->activar_autoregistro == 1 ) {
         ?>
         <span class="pull-right"><a href="<?php echo $url_crear_nueva_cuenta; ?>" class="text-center">Crear una cuenta nueva</a></span>
         <?php
         }// autoregistro
         ?>
       </div>
    </div>
    <!-- /.social-auth-links -->
    <div style="background-color: white; margin-top: 20px">
      <span id="aviso_login"><?php echo $config_portal->aviso_login; ?></span>
    </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

