  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cambiar mi contraseña
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Datos de la nueva contraseña</h3>
          <a href="<?php echo $url_anterior; ?>" class="btn btn-warning pull-right"><i class="fa fa-arrow-circle-left"></i> Regresar</a>

        </div>
        <form method="post" action="<?php echo $url_cambio_contrasena; ?>" class="form">
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
                  <label>Teclee su contraseña actual:</label>
                </div>
                <div class="col-md-6">
                  <input type="password" id="contrasena_actual" name="contrasena_actual" class="form-control" placeholder="Contraseña actual">
                </div>
              </div>
            </div>
          
            <div class="form-group">
              <div class="row">
                <div class="col-md-2">
                  <label>Contraseña nueva:</label>
                </div>
                <div class="col-md-6">
                  <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Teclee su contraseña nueva aquí">
                </div>
              </div>
            </div>
          
            <div class="form-group">
              <div class="row">
                <div class="col-md-2">
                  <label>Confirme contraseña:</label>
                </div>
                <div class="col-md-6">
                  <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" class="form-control" placeholder="Teclee nuevamente su contraseña nueva">
                </div>
              </div>
            </div>
          
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <input type="submit" class="btn btn-primary" value="Aceptar" />
        </div>
        </form>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

