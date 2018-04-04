  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Configuración Layout CSV Nómina 1.2
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Administración</a></li>
        <li><a href="#">Configuración de Layout</a></li>
        <li class="active">CSV Nómina 1.2</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Mapeo de layout para importación</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
          <?php // opciones dependiendo de la existencia de un mapeo previo
          
          if ( $mapeo_nomina != null ) {
              echo "<p><a href='".$url_editar_mapeo."'>Editar</a> mapeo</p>";
          } else {
              echo "<p>Aun no se tiene un mapeo definido. <a href='".$url_editar_mapeo."'>Crear uno</a></p>";
          }              
          ?>
            </div>
          </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
