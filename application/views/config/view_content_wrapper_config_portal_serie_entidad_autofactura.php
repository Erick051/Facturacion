  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Configuración del portal
        <small>Configurar series por entidad para autofacturación</small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" class="form" method="post" action="<?php echo $url_agregar_serie_entidad; ?>">
              <div class="box-body">
                
                <div class="row">
                  <div class="col-md-12">
                        <?php
                        if ( isset($titulo) ) {
                        ?>
                          <div class="<?php echo $tipo_mensaje; ?>">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-exclamation-circle"></i> <?php echo $titulo; ?></h4>
                            <?php echo $mensaje; ?>
                          </div>
                        <?php
                        }
                        ?>
                  </div>
                </div>

                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-12">
                    <h4 class="box-title">Configuración de series por entidad emisora</h4>
                  </div>
                </div>
              
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Entidad</label>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control" id="id_entidad" name="id_entidad">
                        <option value="0" selected>Selecciona una entidad</option>
                      <?php
                      foreach ( $arr_entidades as $entidad ) {
                          echo '<option value="'.$entidad->id_entidad.'">('.$entidad->id_entidad.") ".$entidad->rfc." - ".$entidad->entidad.' ['.$entidad->tipo_entidad.']</option>';
                      }
                      ?>
                      </select>
                    </div>
                  </div>
                </div>
              
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Series disponibles</label>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control" id="serie" name="serie">
                        <option value="0">Selecciona una entidad primero</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Tipo</label>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control" id="tipo_factura" name="tipo_factura">
                        <option selected disabled>Selecciona el tipo</option>
                        <option value="1">Factura</option>
                        <option value="2">Nota de Crédito</option>
                        <option value="3">Factura y Nota de Crédito</option>
                      </select>
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" value="Guardar" class="btn btn-success"> 
                <a href="<?php echo $url_anterior; ?>" class="btn btn-danger">Cancelar</a>
              </div>
              <!-- /.box-footer-->
            </form>
          </div>
          
          <!-- /.box -->
        </div>



      </div>
      
 

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->