  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Conciliación de tickets facturados y no facturados del periodo
      </h1>
      <ol class="breadcrumb">
        <li><a href="#">Tickets</a></li>
        <li class="#">Conciliación</li>
        <li class="active">Búsqueda</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Proceso de conciliación para la sucursal, el periodo y el año elegidos</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-5">
                    <div class="row">
                      <div class="col-md-2">
                        <label>Sucursal:</label>
                      </div>
                      <div class="col-md-10">
                        <?php echo $datos_sucursal->PARTY_NAME; ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2">
                        <label>RFC:</label>
                      </div>
                      <div class="col-md-10">
                        <?php echo $datos_sucursal->JGZZ_FISCAL_CODE; ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2">
                        <label>Dirección:</label>
                      </div>
                      <div class="col-md-10">
                        <?php echo $datos_sucursal->ADDRESS1; ?>
                        <?php echo $datos_sucursal->ADDRESS2; ?>
                        <?php echo $datos_sucursal->ADDRESS3; ?>
                        <?php echo $datos_sucursal->ADDRESS4; ?>
                        C.P. <?php echo $datos_sucursal->POSTAL_CODE; ?>, 
                        <?php echo $datos_sucursal->CITY; ?>, 
                        <?php echo $datos_sucursal->STATE; ?>, 
                        <?php echo $datos_sucursal->COUNTRY; ?>
                      </div>


                    </div>
                  </div>
                  
                  <div class="col-md-2">
                    <label class="form-label">Mes:</label> <?php echo $mes_en_texto; ?>
                  </div>

                  <div class="col-md-2">
                    <label class="form-label">Año:</label> <?php echo $p_ano; ?>
                  </div>
                  
                  <div class="col-md-3">
                    <a class="btn btn-warning" href="<?php echo $url_anterior; ?>"><i class="fa fa-reply"></i> Elegir otro periodo o sucursal</a>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-stripped table-responsive">
                      <tr>
                        <th>Núm. Tickets recibidos</th>
                        <th>Núm. Tickets Facturados</th>
                        <th>Núm. Tickets sin facturar</th>
                        <th>Núm. facturas manuales</th>
                        <th>Conciliación automática</th>
                        <th>Conciliación manual</th>
                        <th>Cierre de conciliación</th>
                        <th>Factura global generada</th>
                      </tr>
                      <tr>
                        <td><?php echo $arr_cifras_conciliacion["tickets_recibidos"]; ?></td>
                        <td><?php echo $arr_cifras_conciliacion["tickets_facturados"]; ?></td>
                        <td><?php echo $arr_cifras_conciliacion["tickets_sin_factura"]; ?></td>
                        <td><?php echo $arr_cifras_conciliacion["facturas_manuales"]; ?></td>
                        <td><a class="btn btn-primary" href="<?php echo $url_conciliacion_automatica; ?>"><i class="fa fa-magic"></i> Ejecutar automática</a></td>
                        <td><a class="btn btn-success" href=""><i class="fa fa-hand-pointer-o"></i> Ejecutar manual</a></td>
                        <td><a class="btn btn-default" href=""><i class="fa fa-lock"></i> Cerrar conciliación</a></td>
                        <td><button class="btn btn-danger"><i class="fa fa-times"></i></button> <button class="btn btn-success"><i class="fa fa-check"></i></button></td>
                      </tr>
                    </table>
                  </div>
                </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tickets preconciliados automaticamente</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-stripped table-responsive">
                        <tr>
                          <th>Núm.</th>
                          <th>TRX Manual</th>
                          <th>Núm. Ticket manual</th>
                          <th>Serie</th>
                          <th>Folio</th>
                          <th>RFC Receptor</th>
                          <th>Nombre receptor</th>
                          <th>Monto de la factura</th>
                          <th>Fecha timbrado</th>
                          <th>Núm. Ticket</th>
                        </tr>
                        <?php
                        if ( count($tickets_preconciliados) > 0 ) {
                            $i = 1;
                            foreach($tickets_preconciliados as $conciliado) {
                                echo '<tr>';
                                echo '  <td>'.$i.'</td>';
                                echo '  <td>'.$conciliado->trxnmanual.'</td>';
                                echo '  <td>'.$conciliado->fxvman.'</td>';
                                echo '  <td>'.$conciliado->serie.'</td>';
                                echo '  <td>'.$conciliado->folio.'</td>';
                                echo '  <td>'.$conciliado->rfc_receptor.'</td>';
                                echo '  <td>'.$conciliado->nombre_receptor.'</td>';
                                echo '  <td>'.$conciliado->total.'</td>';
                                echo '  <td>'.$conciliado->fechatimbrado.'</td>';
                                echo '  <td>'.$conciliado->trxnticket.'</td>';
                                echo '</tr>';
                                $i++;
                            }
                        } else {
                            echo "<tr>";
                            echo '<td colspan="10">No se encontraron registros de preconciliacion automatica</td>';
                            echo "</tr>";
                        }
                        ?>
                      </table>
                    </div>
                  </div>
                </div>
        </div>
        <!-- /.box-body -->
      </div>
      
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tickets preconciliados manualmente</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-stripped table-responsive">
                        <tr>
                          <th>Núm.</th>
                          <th>TRX Manual</th>
                          <th>Núm. Ticket manual</th>
                          <th>Serie</th>
                          <th>Folio</th>
                          <th>RFC Receptor</th>
                          <th>Nombre receptor</th>
                          <th>Monto de la factura</th>
                          <th>Fecha timbrado</th>
                          <th>Núm. Ticket</th>
                        </tr>
                        <?php
                        if ( count($tickets_preconciliados_manual) > 0 ) {
                            $i = 1;
                            foreach($tickets_preconciliados_manual as $conciliado) {
                                echo '<tr>';
                                echo '  <td>'.$i.'</td>';
                                echo '  <td>'.$conciliado->trxnmanual.'</td>';
                                echo '  <td>'.$conciliado->fxvman.'</td>';
                                echo '  <td>'.$conciliado->serie.'</td>';
                                echo '  <td>'.$conciliado->folio.'</td>';
                                echo '  <td>'.$conciliado->rfc_receptor.'</td>';
                                echo '  <td>'.$conciliado->nombre_receptor.'</td>';
                                echo '  <td>'.$conciliado->total.'</td>';
                                echo '  <td>'.$conciliado->fechatimbrado.'</td>';
                                echo '  <td>'.$conciliado->trxnticket.'</td>';
                                echo '</tr>';
                                $i++;
                            }
                        } else {
                            echo "<tr>";
                            echo '<td colspan="10">No se encontraron registros de preconciliacion manual</td>';
                            echo "</tr>";
                        }
                        ?>
                      </table>
                    </div>
                  </div>
                </div>
        </div>
        <!-- /.box-body -->
      </div>
      
      <div class="example-modal">
        <div class="modal modal-danger" id="modal_error">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Verifique los datos de consulta</h4>
              </div>
              <div class="modal-body">
                <p><div id="div_mensaje_error"></div></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
