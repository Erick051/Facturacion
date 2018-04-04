
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
        <li class="#">Muestra</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
        <h4>Definición de layout</h4>

        <p>Verifique que el archivo cargado es correcto</p>
      </div>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Datos cargados</h3>
          <p>Numero de columnas leídas: <?php echo count($encabezado); ?></p>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <h4>Muestra de datos cargados</h4>
          <div class="row">
            <div class="col-md-12">
               <div class="table-responsive">
               <table class="table table-stripped table-responsive table-bordered">
                 <tr>
                   <?php
                   $contador = 1;
                   foreach($encabezado as $unEncabezado) {
                       echo "<th class='bg-orange'>Columna ".$contador."</th>";
                       $contador++;
                   }
                   ?>
                 </tr>
                 <tr>
                   <?php
                   $contador = 1;
                   foreach($encabezado as $unEncabezado) {
                       echo "<th>".$unEncabezado->valor."</th>";
                   }
                   ?>
                 </tr>
                 <tr>
                   <?php
                   foreach($muestra as $unaMuestra) {
                       echo "<th>".$unaMuestra->valor."</th>";
                   }
                   ?>
                 </tr>
               </table>
               </div>
               <a href="<?php echo $url_configurar_mapeo; ?>" class="btn btn-primary">Configurar mapeo con esta estructura</a> <a href="<?php echo $url_anterior; ?>" class="btn btn-warning"><i class="fa fa-reply"></i> Regresar</a>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Este mapeo funciona para emisión de comprobantes de nómina mediante importación de archivo csv
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
