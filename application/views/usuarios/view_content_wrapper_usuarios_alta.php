  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Control de acceso
      </h1>
      <ol class="breadcrumb">
        <li><a href="#">Usuarios</a></li>
        <li class="active"> alta</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Datos de la cuenta</h3>
          <a href="<?php echo $url_anterior; ?>" class="btn btn-warning pull-right"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="<?php echo $url_action_alta_usuario; ?>">
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
                 <input type="text" class="form-control" id="login" name="login" required>
               </div>
             </div>
            </div>

            <div class="form-group">

             <div class="row">
               <div class="col-md-2">
                 <label>Contraseña</label>
               </div>
               <div class="col-md-5">
                 <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Teclee su contraseña" required> 
               </div>
               <div class="col-md-5">
                 <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Confirme su contraseña" required>
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
                   <option value="">Elegir pregunta</option>
                   <?php
                   $selected = "";
                   // listado de preguntas
                   foreach ($arrpreguntas as $pregunta) {
                     echo '<option value="'.$pregunta->id_pregunta_recuperacion.'" '.$selected.'>'.$pregunta->pregunta.'</option>';
                   }
                   ?>
                 </select>
               </div>
               <div class="col-md-5">
                 <input type="text" class="form-control" id="respuesta_recuperar_contrasena" name="respuesta_recuperar_contrasena" placeholder="Respuesta" required>
               </div>
             </div>
            </div>

            <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>Nombre</label>
               </div>
               <div class="col-md-3">
                 <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre(s)" required>
               </div>
               <div class="col-md-3">
                 <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido paterno" required>
               </div>
               <div class="col-md-3">
                 <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Apellido materno">
               </div>

             </div>
            </div>

            <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>email</label>
               </div>
               <div class="col-md-3">
                 <input type="email" class="form-control" id="email" name="email" placeholder="Dirección email" required>
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
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
