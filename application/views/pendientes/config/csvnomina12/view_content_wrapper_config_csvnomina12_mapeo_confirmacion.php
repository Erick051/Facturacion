
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
        <li class="active">Nómina 1.2</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
        <h4>Definición de layout para importación</h4>
      </div>
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <?php // opciones dependiendo de la existencia de un mapeo previo
          
          if ( $mapeo_nomina != null ) {
              echo "<p>Editar mapeo</p>";
          } else {
              echo "<p>Aun no se tiene un mapeo definido. Crear uno</p>";
          }
              
          <h3 class="box-title">Tabla de conversión</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
               <table class="table table-stripped">
                 <tr>
                   <th>ID</th>
                   <th>Campo</th>
                   <th>Indice en el archivo</th>
                 </tr>
                   <?php
                   if ( count($mapeo_nomina) > 0 ) {
                       $conteo = 0;
                       foreach($mapeo_nomina as $unMapeo) {
                           $conteo++;
                           echo "<tr>";
                           echo "<td>".$conteo."</td>";
                           echo "<td>".$mapeo_nomina->campo_layout."</td>";
                           echo "<td>".$mapeo_nomina->indice_en_archivo."</td>";
                           echo "</tr>";
                        }
                   } else {
                       echo "<tr><td colspan='3'>No se tiene definido el layout aun.</td></tr>";
                   }
                   ?>
               </table>
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
