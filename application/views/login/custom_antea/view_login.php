<body class="hold-transition login-page">

    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><?php echo $config_portal->titulo_pantalla_principal; ?></a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <div class="row">
          <div class="col-md-3">
            <br>
            <img src="<?php echo base_url()."assets_custom/imgcustom/loto_antea.png"; ?>" class="img-responsive img-rounded center-block" width="60%">
          </div>
          <div class="col-md-9">
          
          
        <div class="row">
         <div class="col-md-12 login-box-msg">
           <h3>Antea Lifestyle Center "El mundo en un solo lugar"</h3>
         </div>
        </div>
        <br>
        <p class="login-box-msg">
        - Le recordamos que solamente podrá generar su comprobante durante el transcurso del mes en el que haya realizado su compra.
        </p>
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
          if ( $config_portal->usar_contrasena == true ) {
          ?>
          <div class="form-group has-feedback">
            <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Password">
          </div>
          <?php
          } else {
              echo '<div class="form-group has-feedback">';
              echo '   <input type="password" id="contrasena" name="contrasena" class="form-control" style="display: none;" placeholder="Password">';
              echo '</div>';
          }
          
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
              <button type="submit" class="btn btn-success btn-block btn-flat">Aceptar</button>
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
       <div class="col-md-6">
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
          
          
          
          
          
          </div>
        </div>
      

      </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
  </div>



