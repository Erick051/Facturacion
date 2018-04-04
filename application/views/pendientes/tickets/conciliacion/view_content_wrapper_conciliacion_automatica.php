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
        <li class="active">Automática</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Proceso de conciliación automática para la sucursal, el periodo y el año elegidos</h3>
          <p>Este proceso realizará una relación de facturas manuales que hagan referencia a un ticket de consumo, cancelando el ticket en el portal de autofacturación y descartándolo de la consiguiente factura global.
          El proceso puede tardar unos minutos dependiendo de la cantidad de tickets que se tenga en el periodo.</p>
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
                  <div class="col-md-3">
                    <label class="form-label">Sucursal:</label> SUCURSAL AQUI
                  </div>
                  
                  <div class="col-md-3">
                    <label class="form-label">Mes:</label> MES AQUI
                  </div>

                  <div class="col-md-3">
                    <label class="form-label">Año:</label> AÑO AQUI
                  </div>
                  
                  <div class="col-md-3">
                    <a class="btn btn-warning" href="<?php echo $url_anterior; ?>"><i class="fa fa-reply"></i> Regresar</a>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /.box-body -->
        <form role="form" method="post" action="<?php echo $url_ejecutar_conciliacion_automatica; ?>">
        <input type="hidden" id="num_tickets_conciliados" name="num_tickets_conciliados" value="<?php echo count($arr_facturas_manuales);?>">
        <input type="hidden" id="mes" name="mes" value="<?php echo $mes;?>">
        <input type="hidden" id="ano" name="ano" value="<?php echo $ano;?>">
        <input type="hidden" id="id_sucursal" name="id_sucursal" value="<?php echo $id_sucursal;?>">
        <input type="hidden" id="id_organizacion" name="id_organizacion" value="<?php echo $id_organizacion;?>">
        <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $id_usuario;?>">

        <div class="box-body">
          <div id="resultado_conciliacion_automatica">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-stripped table-responsive table-condensed">
                  <tr>
                    <th colspan="10">Se encontraron las siguientes coincidencias</th>
                  </tr>
                  <tr>
                    <th colspan="7">Factura Manual</th>
                    <th colspan="3">Referencia al ticket</th>
                  </tr>
                  <tr>
                    <th>Núm.</th>
                    <th>ID Fact. Manual</th>
                    <th>TRX Manual</th>
                    <th>Num. Ticket Manual</th>
                    <th>Estatus Factura Manual</th>
                    <th>Serie</th>
                    <th>Folio</th>
                    <th>RFC Receptor</th>
                    <th>Receptor</th>
                    <th>Total</th>
                    <th>Fecha Timbrado</th>
                    <th>ID Ticket</th>
                    <th>TRX Ticket</th>
                    <th>Estatus ticket</th>
                  </tr>
                  <?php
                  
                  for ($i = 1; $i <= count($arr_facturas_manuales); $i++) {
                      echo '<input type="hidden" id="ctid_factura_manual'.$i.'" name="ctid_factura_manual'.$i.'" value="'.$arr_facturas_manuales[$i]["ctidmanual"].'">';
                      echo '<input type="hidden" id="ctid_ticket'.$i.'" name="ctid_ticket'.$i.'" value="'.$arr_facturas_manuales[$i]["ctidticket"].'">';
                      echo "<tr>";
                      echo "<td>".$i."</td>";
                      echo '<td>'.$arr_facturas_manuales[$i]["ctidmanual"].'</td>';
                      echo '<td>'.$arr_facturas_manuales[$i]["trxnmanual"].'</td>';
                      echo '<td>'.$arr_facturas_manuales[$i]["fxvman"].'</td>';
                      echo '<td>'.$arr_facturas_manuales[$i]["nconfman"].'</td>';
                      echo '<td>'.$arr_facturas_manuales[$i]["serie"].'</td>';
                      echo '<td>'.$arr_facturas_manuales[$i]["folio"].'</td>';
                      echo '<td>'.$arr_facturas_manuales[$i]["rfc_receptor"].'</td>';
                      echo '<td>'.$arr_facturas_manuales[$i]["nombre_receptor"].'</td>';
                      echo '<td>'.$arr_facturas_manuales[$i]["total"].'</td>';
                      echo '<td>'.$arr_facturas_manuales[$i]["fechatimbrado"].'</td>';
                      echo '<td>'.$arr_facturas_manuales[$i]["ctidticket"].'</td>';
                      echo '<td>'.$arr_facturas_manuales[$i]["trxnticket"].'</td>';
                      echo '<td>'.$arr_facturas_manuales[$i]["nconfticket"].'</td>';
                      echo "</tr>";
                      
                  }
                  
                  ?>
                </table>
              </div>
            </div>
          </div>
          
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-success">Ejecutar conciliación</button>
        </div>
      </div>
      </form>
      <!-- /.box -->

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
