
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Configuración de mapeo de CSV
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Configuración</a></li>
        <li><a href="#">Layout CSV</a></li>
        <li class="#">Nómina 1.2</li>
        <li class="#">Cargar archivo CSV</li>
        <li class="#">Finalizar mapeo</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
        <h4>Definición de layout</h4>

        <p>Finalizar mapeo</p>
      </div>

      <!-- /.box -->
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Encabezado - Datos generales del documento</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>

        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 1 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      
      <!-- emisor y reeeptor -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Bill to Customer</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 2 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      
      <!-- Lineas y conceptos generales del documento -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Customer</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 3 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      
      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Ship to</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 4 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      
      
      
      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Pedido</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 5 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      
      
      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Flex Header</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 6 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      
      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Líneas</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 7 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      
      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Flex Lines</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table class="table table-stripped">
            <tr>
             <th>Campo</th>
             <th>Índice en archivo</th>
             <th>Dato muestra</th>
            </tr>
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 8 ) {
                ?>
            <tr>
              <td>
                  <?php echo $config->campo_layout; ?>
              </td>
              <td>
                  <?php echo $config->indice_en_archivo; ?>
              </td>
              <td>
                  <?php echo $config->dato_muestra; ?>
              </td>
            </tr>
            <?php
                }
            }
            ?>
          </table>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Taxes</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 9 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->


      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border bg-yellow-active">
          <h3 class="box-title">Nómina - Encabezado del complemento</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 10 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      
      
      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border bg-yellow disabled">
          <h3 class="box-title">Nómina - Emisor</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 11 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      
      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border bg-yellow disabled">
          <h3 class="box-title">Nómina - Receptor</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 12 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->


      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border bg-yellow-active">
          <h3 class="box-title">Nómina - Percepciones</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 13 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      
      
      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border bg-yellow-active">
          <h3 class="box-title">Nómina - Deducciones</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 14 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border bg-yellow-active">
          <h3 class="box-title">Nómina - Otros pagos</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 15 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
      
      <!-- SEcciones del complemento -->
      <div class="box">
        <div class="box-header with-border bg-yellow-active">
          <h3 class="box-title">Nómina - Incapacidades</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            foreach ($configuracion_mapeo as $config) {
                if ( $config->id_seccion == 16 ) {
                ?>
          <div class="row">
            <div class="col-md-3">
                <label>Campo: <?php echo $config->campo_layout; ?></label>
            </div>
            <div class="col-md-3">
                <label>Indice en Archivo: <?php echo $config->indice_en_archivo; ?></label>
            </div>
            <div class="col-md-3">
                <label>Dato muestra: <?php echo $config->dato_muestra; ?></label>
            </div>
          </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
           <a href="<?php echo $url_finalizar; ?>" class="btn btn-primary"><i class="fa fa-save"></i> Finalizar mapeo</a> <a href="<?php echo $url_anterior; ?>" class="btn btn-warning"><i class="fa fa-reply"></i> Regresar</a>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
