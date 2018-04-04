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
        <li class="active">Conciliación</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Elija el mes y el año de emisión de tickets</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
            <form role="form" id="formulario_inicio_conciliacion" method="post" action="<?php echo $url_consultar_ano_mes; ?>">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-label">Mes</label>
                      <select class="form-control" id="id_mes" name="id_mes">
                        <option value="-2" selected>Mes</option>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-label">Año</label>
                      <select class="form-control" id="id_ano" name="id_ano">
                        <option value="-2" selected>Año</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                      </select>
                    </div>
                  </div>
                </div>

              </div>
              <div class="box-footer">
                <button type="button" class="btn btn-success" onclick="validar_consulta();">Aceptar</button>
              </div>
            </form>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      
      <!-- si ya se hizo la conulta -->
      <?php
      if ( isset($mes) ) {
      ?>
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Elija una sucursal para proceder a realizar la conciliación</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-stripped table-responsive">
                <tr>
                  <th>Núm.</th>
                  <th>Organización</th>
                  <th>Id Sucursal</th>
                  <th>RFC</th>
                  <th>Sucursal</th>
                  <th>Usuario</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Fin</th>
                  <th>Estatus</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Grupo Restaurantero del Centro</td>
                  <td>139</td>
                  <td>GRCXXXXXX</td>
                  <td>La Mansión T1</td>
                  <td>Ivan Vega</td>
                  <td>2017-03-18</td>
                  <td>--</td>
                  <?php
                  $url_continuar_conciliacion = $url_conciliacion_busqueda."/".$mes."/".$ano."/100/139";
                  ?>
                  <td><a href="<?php echo $url_continuar_conciliacion; ?>">En Proceso</a></td>
                </tr>
              </table>
            
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <?php
      } // SI YA SE HIZO LA CONSULTA
      ?>
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
