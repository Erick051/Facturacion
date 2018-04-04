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
           <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>Login</label>
               </div>
               <div class="col-md-5">
                 <input type="text" class="form-control" id="login" name="login">
               </div>
             </div>
            </div>
            
            <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>Contraseña</label>
               </div>
               <div class="col-md-5">
                 <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Teclee su contraseña">
               </div>
               <div class="col-md-5">
                 <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Confirme su contraseña">
               </div>
               
             </div>
             <p class="help-block">La contraseña y su confirmación deben coincidir</p>
            </div>
            
            <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>Recuperación de contraseña</label>
               </div>
               <div class="col-md-5">
                 <input type="text" class="form-control" id="pista_recupera_contrasena" name="pista_recupera_contrasena" placeholder="Pista para recuperar su contraseña">
               </div>
               <div class="col-md-5">
                 <input type="text" class="form-control" id="palabra_recupera_contrasena" name="palabra_recupera_contrasena" placeholder="Respuesta">
               </div>
               
             </div>
             <p class="help-block">Teclee una pregunta que sólo ud conozca y la respuesta a esta pregunta. Se utilizará para recuperar una contraseña y desbloquear su cuenta</p>
            </div>

          </div>
          <!-- /.box-body -->

      </div>
      <!-- /.box -->
      
      
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Datos personales del usuario</h3>
        </div>
        <!-- /.box-header -->
          <div class="box-body">

           <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>Nombre</label>
               </div>
               <div class="col-md-3">
                 <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre(s)" >
               </div>
               <div class="col-md-3">
                 <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido paterno">
               </div>
               <div class="col-md-3">
                 <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Apellido materno">
               </div>


             </div>
            </div>
            
            <div class="form-group">
             <div class="row">
               <div class="col-md-2">
                 <label>Email</label>
               </div>
               <div class="col-md-5">
                 <input type="email" class="form-control" id="email" name="email" placeholder="Dirección principal">
               </div>
               <div class="col-md-5">
                 <input type="email" class="form-control" id="email_secundario" name="email_secundario" placeholder="Dirección secundaria">
               </div>
               
             </div>
            </div>
          
          
          </div>
          <!-- /.box-body -->
  
      </div>
      <!-- /.box -->

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Datos de nómina</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">

          
          
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Aceptar</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

