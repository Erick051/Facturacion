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
          <h3 class="box-title">Datos de la cuenta</h3>
          <a href="<?php echo $url_anterior; ?>" class="btn btn-warning pull-right"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="<?php echo $url_actualizar_datos_usuario; ?>">
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
             <label>Tipo de usuario</label>
           </div>
           <div class="col-md-5">
             <select class="form-control" id="id_tipo_usuario" name="id_tipo_usuario" required>
               <option value="">Elige el tipo de usuario</option>
               <?php
               $selected = "";
               // listado de tipos de usuario
               foreach ($arrtipousuario as $tipousuario) {
                   if ( $tipousuario->id_tipo_usuario == $usuario->tipo_usuario ) {
                       $selected = "selected";
                   } else {
                       $selected = "";
                   }
                   echo '<option value="'.$tipousuario->id_tipo_usuario.'" '.$selected.'>'.$tipousuario->clave_tipo_usuario.'</option>';
                  }

               ?>
             </select>
           </div>
           </div>
           </div>

           <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>Login</label>
               </div>
               <div class="col-md-5">
                 <input type="text" class="form-control" id="login" name="login" value="<?php echo $usuario->login; ?>" readonly>
                 <input type="hidden" id="id_usuario_editado" name="id_usuario_editado" value="<?php echo $usuario->id_usuario_pss; ?>" required>
               </div>
               <div class="col-md-3">
                <input type="button" name="ver_pass" id="ver_pass" value="Cambiar contraseña" onclick="if(document.getElementById('password').style.display == 'none'){document.getElementById('ver_pass').value='No cambiar contraseña'; document.getElementById('password').style ='display:block'}else{document.getElementById('password').style = 'display:none'}">
               </div>
             </div>
            </div>

            <div class="form-group">

             <div class="row">
              <div id="password" style="display:none">
               <div class="col-md-2">
                 <label>Contraseña</label>
               </div>
                 <div class="col-md-5">
                   <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Teclee su contraseña" onchange="if (document.getElementById('confirmar_contrasena').value!=''&&document.getElementById('contrasena').value != document.getElementById('confirmar_contrasena').value) {alert('Los campos de contraseñas son diferentes.');document.getElementById('confirmar_contrasena').value='';document.getElementById('contrasena').value=''}">
                 </div>
                 <div class="col-md-5">
                   <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Confirme su contraseña" onchange="if (document.getElementById('contrasena').value != document.getElementById('confirmar_contrasena').value) {alert('Los campos de contraseñas son diferentes.');document.getElementById('confirmar_contrasena').value=''}">
                 </div>
               </div>

             </div>

            </div>

            <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>Recuperación de contraseña</label>
               </div>
               <div class="col-md-5">
                 <select class="form-control" id="id_pregunta_recuperacion" name="id_pregunta_recuperacion" required>
                   <option value="">Elige una</option>
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
                 <input type="text" class="form-control" id="respuesta_recuperar_contrasena" name="respuesta_recuperar_contrasena" placeholder="Respuesta" value="<?php echo $usuario->respuesta_recuperar_contrasena; ?>" required>
               </div>
             </div>
            </div>

            <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>Nombre</label>
               </div>
               <div class="col-md-3">
                 <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre(s)" value="<?php echo $usuario->nombre; ?>" required>
               </div>
               <div class="col-md-3">
                 <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido paterno" value="<?php echo $usuario->apellido_paterno; ?>" required>
               </div>
               <div class="col-md-3">
                 <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Apellido materno" value="<?php echo $usuario->apellido_materno; ?>">
               </div>

             </div>
            </div>

            <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>email</label>
               </div>
               <div class="col-md-3">
                 <input type="email" class="form-control" id="email" name="email" placeholder="Dirección email" value="<?php echo $usuario->email; ?>" required>
               </div>
             </div>
            </div>

<?php
/*
            <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>Perfil</label>
               </div>
               <div class="col-md-5">
                 <select id="id_perfil" name="id_perfil" class="form-control">
                   <option value="-1">Elegir perfil</option>
                   <?php
                   foreach ($arrperfiles as $perfil) {
                     echo '<option value="'.$perfil->id_perfil.'" '.$selected.'>'.$perfil->d_perfil.'</option>';
                   }
                   ?>
                 </select>
               </div>
             </div>
            </div>
*/
?>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Aceptar</button> <a href="<?php echo $url_anterior; ?>" class="btn btn-danger">Cancelar</a>
          </div>
        </form>
      </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
