  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Configuración del portal
        <small>Configurar flex headers para identificación de transacción</small>
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
            <form role="form" class="form" method="post" action="<?php echo $url_agregar_campo_flex; ?>">
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
                    <h4 class="box-title">Configuración del flex header</h4>
                  </div>
                </div>
              
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Etiqueta del campo</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" id="etiqueta_flex_header" name="etiqueta_flex_header" class="form-control" required>
                    </div>
                  </div>
                </div>
              
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Flex header (sólo aparecen los no utilizados)</label>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control" id="id_flex_header" name="id_flex_header" required>
                      <?php
                      foreach ( $arr_flex_headers as $flexheader ) {
                          echo '<option value="'.$flexheader->id_info_adicional.'">'.$flexheader->campo_adicional." - ".$flexheader->descripcion.'</option>';
                      }
                      ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Tipo de dato para mostrar el flex header</label>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control" id="id_tipo_dato" name="id_tipo_dato" required>
                      <?php
                      foreach ( $arr_tipodato as $tipo_dato ) {
                          echo '<option value="'.$tipo_dato->id_tipo_dato.'">'.$tipo_dato->d_tipo_dato.'</option>';
                      }
                      ?>
                      </select>                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Guía del campo (placeholder)</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" id="placeholder" name="placeholder" class="form-control">
                    </div>
                  </div>
                </div>

           
                

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" value="Guardar" class="btn btn-success"> <a href="<?php echo $url_anterior; ?>" class="btn btn-danger">Cancelar</a>
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