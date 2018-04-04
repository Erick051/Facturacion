  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mis Reportes
      </h1>
      <ol class="breadcrumb">
        <li><a href="#">Consultas</a></li>
        <li class="active"> Mis Reportes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Reportes generados para</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-3">
                      <label>RFC</label>
                    </div>
                    <div class="col-md-3">
                      <?php echo $usuario->rfc; ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <label>Nombre</label>
                    </div>
                    <div class="col-md-3">
                      <?php echo $usuario->nombre." ".$usuario->apellido_paterno." ".$usuario->apellido_materno; ?>
                    </div>
                  </div>

                </div>
                <div class="col-md-6">
                  
                  <div class="callout callout-warning">
                    <h4>Atención</h4>

                    <p>Los reportes con más de 10 días de antigüedad serán borrados automáticamente.</p>
                  </div>

                </div>

              </div>
            </div>
            <!-- /.box-body -->
          </div>
    
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de reportes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="listado_comprobantes" class="table table-striped table-condensed table-hover dataTable">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Fecha consulta</th>
                    <th>Emisor</th>
                    <th>Receptor</th>
                    <th>Sucursal</th>
                    <th>Tipo Comprobante</th>
                    <th>Estatus comprobante</th>
                    <th>Serie</th>
                    <th>Folio inicial</th>
                    <th>Folio final</th>
                    <th>Fecha emisión inicio</th>
                    <th>Fecha emisión fin</th>
                    <th>Resultado ejecución</th>
                    <th>Estatus</th>
                    <th>Descargar</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $conteo = 0;
                  foreach ($arrreportes as $reporte) {
                      $conteo++;
                      echo '<tr>';
                      echo '  <td>'.$conteo.'</td>';
                      echo '  <td>'.$reporte->fecha_consulta.'</td>';
                      echo '  <td>'.$reporte->rfc_nombre_emisor.'</td>';
                      echo '  <td>'.$reporte->rfc_nombre_receptor.'</td>';
                      echo '  <td>'.$reporte->sucursal.'</td>';
                      echo '  <td>'.$reporte->tipo_comprobante.'</td>';
                      echo '  <td>'.$reporte->estatus_comprobante.'</td>';
                      echo '  <td>'.$reporte->serie.'</td>';
                      echo '  <td>'.$reporte->folio_inicial.'</td>';
                      echo '  <td>'.$reporte->folio_final.'</td>';
                      echo '  <td>'.$reporte->fecha_emision_inicio.'</td>';
                      echo '  <td>'.$reporte->fecha_emision_fin.'</td>';
                      echo '  <td>'.$reporte->cod_resultado.'<br>'.$reporte->cod_resultado.'</td>';
                      echo '  <td>'.$reporte->estatus_reporte.'</td>';
                      echo '  <td>'.$reporte->ruta_archivo_reporte.'</td>';
                      echo '</tr>';
                  }
                  ?>
                 </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

