<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <?php echo $config_portal->titulo_pantalla_principal; ?>
  </div>

  <div class="register-box-body">
    <?php
    // se definen las etiquetas de los apartados
    if ( $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN || $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN_RFC ) {
        $etiqueta_crear_cuenta    = "Nuevo registro para facturación";
        $etiqueta_login           = "RFC";
        $etiqueta_boton_registrar = "Registrarme";
        $etiqueta_nombre_usuario  = "Nombre del contacto";
    } else {
        $etiqueta_crear_cuenta    = "Crear cuenta";
        $etiqueta_login           = "Login";
        $etiqueta_boton_registrar = "Continuar";
        $etiqueta_nombre_usuario  = "Nombre del usuario";
    }
    ?>
    <p class="login-box-msg"><?php echo $etiqueta_crear_cuenta; ?></p>

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
    
    <form action="<?php echo $url_nuevo_usuario; ?>" method="post">
      <div class="form-group has-feedback">
        <label><?php echo $etiqueta_nombre_usuario; ?></label>
      </div>
      <div class="form-group has-feedback">
        <input style="text-transform:uppercase;" type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre(s)" required>
      </div>
      <div class="form-group has-feedback">
        <input style="text-transform:uppercase;" type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" placeholder="Apellido paterno" required>
      </div>
      <div class="form-group has-feedback">
        <input style="text-transform:uppercase;" type="text" name="apellido_materno" id="apellido_materno" class="form-control" placeholder="Apellido materno">
      </div>


      <?php
      // si el login esta marcado como usar RFC, este campo queda oculto y prepoblado
      if ( $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN_RFC ) {
      ?>
        <input type="hidden" id="login" name="login" class="form-control" placeholder="<?php echo $etiqueta_login; ?>" value="<?php echo $RFC; ?>" readonly>
      <?php
      } else {
          // se usa login como cuenta
      ?>
      <div class="form-group has-feedback">
        <label><?php echo $etiqueta_login; ?></label>
      </div>
      <div class="form-group has-feedback">
        <input type="text" id="login" name="login" class="form-control" placeholder="<?php echo $etiqueta_login; ?>" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <?php
      }
      ?>


      <?php
      // si el login esta marcado como usar RFC, se usa esta etiqueta
      if ( $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN || $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN_RFC ) {
          $mostrar_contrasena   = 'style="display: none;"';
          $contrasena_requerida = null;
      } else {
          $mostrar_contrasena   = null;
          $contrasena_requerida = "required";
      }
      ?>
        
      <div class="form-group has-feedback" <?php echo $mostrar_contrasena; ?>>
        <label id="label_pass">Contraseña</label>
      </div>
      <div class="form-group has-feedback" <?php echo $mostrar_contrasena; ?>>
        <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Contraseña" <?php echo $contrasena_requerida; ?>>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback" <?php echo $mostrar_contrasena; ?>>
        <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" class="form-control" placeholder="Confirme su contraseña" <?php echo $contrasena_requerida; ?>>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <script>

        function chk_pass(){
            /*
          var pass1 =document.getElementById("contrasena").value;
          var pass2 =document.getElementById("confirmar_contrasena").value; 
          if(pass1!=pass2){
            alert("Las contraseñas no coinciden.");
            document.getElementById("btn_registrar").disabled=true;
          }
          else{
            document.getElementById("btn_registrar").disabled=false;
          }
          */
        }
        
      </script>
      <div class="form-group has-feedback">
        <label>Email de contacto</label>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <?php
      // si el login esta marcado como usar RFC, se usa esta etiqueta
      if ( $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN || $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN_RFC ) {
          $mostrar_recuperacion_contrasena   = 'style="display: none;"';
          $recuperacion_contrasena_requerida = null;
      } else {
          $mostrar_recuperacion_contrasena   = null;
          $recuperacion_contrasena_requerida = "required";
      }
      ?>
      <div class="form-group has-feedback" <?php echo $mostrar_recuperacion_contrasena; ?>>
        <label>Recuperación de contraseña</label>
      </div>

      <div class="form-group has-feedback" <?php echo $mostrar_recuperacion_contrasena; ?>>
        <label>seleccione una pregunta:</label>
        <select name="id_pregunta_recuperacion" id="id_pregunta_recuperacion" class="form-control" <?php echo $recuperacion_contrasena_requerida; ?>>
          <option selected></option>
          <?php
          foreach ($arr_preguntas_recuperacion as $pregunta) {
              echo '<option value="'.$pregunta->id_pregunta_recuperacion.'">'.$pregunta->pregunta.'</option>';
          }
          ?>
        </select>
      </div>
      <div class="form-group has-feedback" <?php echo $mostrar_recuperacion_contrasena; ?>>
        <input type="text" name="respuesta_recuperar_contrasena" id="respuesta_recuperar_contrasena" class="form-control" placeholder="Respuesta a la pregunta" <?php echo $recuperacion_contrasena_requerida; ?>>
      </div>
      
      
      <?php
      // si se esta usando solo login con rfc
      if ( $config_portal->usar_contrasena == CONTROL_ACCESO_SOLO_LOGIN_RFC ) {
          // se piden los datos fiscales
      ?>

      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label>RFC</label>
          </div>
          <div class="col-md-4">
            <input type="text" id="rfc" name="rfc" class="form-control" style="text-transform:uppercase;" value="<?php echo $RFC; ?>" maxlength="13" readonly>
          </div>
          <div class="col-md-2">
            <Label>Num. Reg. Id. Trib.</label>
          </div>
          <div class="col-md-4">
            <input type="text" id="num_reg_id_trib" name="num_reg_id_trib" class="form-control" placeholder="Solo para ciudadanos no mexicanos">
          </div>
        </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <Label>Nombre o razón social</label>
          </div>
          <div class="col-md-4">
            <input style="text-transform: capitalize" type="text" id="cliente" name="cliente" class="form-control" required>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label>email Facturación</label>
          </div>
          <div class="col-md-4">
            <input type="text" id="email_facturacion" name="email_facturacion" class="form-control" required>
          </div>
          <div class="col-md-2">
            <label>Confirme email facturación</label>
          </div>
          <div class="col-md-4">
            <input type="text" id="email_confirma" name="email_confirma" class="form-control" required>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- emisor -->
        <div class="col-md-12">
          <h4 class="box-title">Domicilio </h4>
        </div>
      </div>
      
      <div class="form-group">
        <div class="row">
          <!-- emisor -->
          <div class="col-md-1">
            <label>Calle</label>
          </div>
          <div class="col-md-11">
            <input type="text" id="calle" name="calle" class="form-control">
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-1">
            <label>Núm. exterior</label>
          </div>
          <div class="col-md-2">
            <input type="text" id="num_exterior" name="num_exterior" class="form-control">
          </div>
          <div class="col-md-1">
            <Label>Núm. interior</label>
          </div>
          <div class="col-md-2">
            <input type="text" id="num_interior" name="num_interior" class="form-control">
          </div>
          <div class="col-md-1">
            <label>Código Postal</label>
          </div>
          <div class="col-md-2">
            <input type="text" id="cp" name="cp" class="form-control">
          </div>
          <div class="col-md-1">
            <label></label>
          </div>
          <div class="col-md-2">
            <input type="button" id="no_col" name="no_col" class="form-control" value="Mi colonia no aparece" title="Presiona para que te permita escribir el nombre de tu colonia en caso de que no exista en la lista." style="background-color: green; color: white;box-shadow: 0px 0px 5px black">
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-1">
            <label>Colonia</label>
          </div>
          <div class="col-md-11" id="div_colonia">
            <input type="text" id="colonia" name="colonia" class="form-control"/>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-1">
            <label>Municipio</label>
          </div>
          <div class="col-md-5" id="div_municipio">
            <input type="text" id="municipio" name="municipio" class="form-control"/>
          </div>
          <div class="col-md-1">
            <label>Localidad</label>
          </div>
          <div class="col-md-5" id="div_localidad">
            <input type="text" id="localidad" name="localidad" class="form-control"/>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-1">
            <label>Estado</label>
          </div>
          <div class="col-md-2" id="div_estado">
            <input type="text" id="estado" name="estado" class="form-control"/>
          </div>
          <div class="col-md-1">
            <label>País</label>
          </div>
          <div class="col-md-2">
            <input type="text" id="pais" name="pais" class="form-control"/>
          </div>
        </div>
      </div>
      <?php
      } // pedir datos fiscales cuando se configuro acceso por RFC como login
      ?>

      <div class="row">
        <!-- /.col -->
        <div class="col-md-6">
          <a class="btn btn-default btn-block" href="<?php echo $url_anterior; ?>" class="text-center">Regresar al inicio</a>
        </div>
        <div class="col-md-6">
          <button id="btn_registrar" type="submit" class="btn btn-primary btn-block"><?php echo $etiqueta_boton_registrar; ?></button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

