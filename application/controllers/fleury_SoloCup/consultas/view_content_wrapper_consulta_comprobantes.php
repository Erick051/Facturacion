  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Consulta de comprobantes
      </h1>
      <ol class="breadcrumb">
        <li><a href="#">Consultas</a></li>
        <li class="active"> Comprobantes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Parámetros de búsqueda</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <?php
              if ( isset($titulo) ) {
              ?>
                <div class="<?php echo $tipo_mensaje; ?>">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> <?php echo $titulo; ?></h4>
                  <?php echo $mensaje; ?>
                </div>
              <?php
              }
              ?>
            
            
            <form method="post" action="<?php echo $url_ejecutar_consulta_comprobantes; ?>" >

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>Emisor</label>
                    </div>
                    <div class="col-md-3">
                      <input type="text" class="form-control" id="rfc_nombre_emisor" name="rfc_nombre_emisor" placeholder="RFC o nombre">
                    </div>
                    
                    <div class="col-md-1">
                      <label>Receptor</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" class="form-control" id="rfc_nombre_receptor" name="rfc_nombre_receptor" placeholder="RFC o nombre">
                    </div>

                  </div>
                </div>
                
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>Sucursal</label>
                    </div>
                    <div class="col-md-3">
                      <select class="form-control" id="sucursal" name="sucursal">
                        <option value="-1">Todas</option>
                      </select>
                    </div>
                    
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="row">
                  </div>
                </div>
                 
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>Tipo de comprobante</label>
                    </div>
                    <div class="col-md-3">
                      <select class="form-control" name="tipo_comprobante" id="tipo_comprobante">
                        <option value="0">Todos</option>
                        <?php
                        /*
                        foreach ($arracciones as $accion) {
                            echo '<option value="'.$accion->id_accion.'">'.$accion->d_accion.'</option>';
                        }
                        */
                        ?>
                      </select>
                    </div>
                    
                    <div class="col-md-1">
                      <label>Estatus</label>
                    </div>
                    <div class="col-md-4">
                      <select class="form-control" name="estatus_comprobante" id="estatus_comprobante">
                        <option value="-1">Todos</option>
                        <option value="1">Vigentes</option>
                        <option value="0">Cancelados</option>
                      </select>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>Serie</label>
                    </div>
                    <div class="col-md-3">
                      <input type="text" class="form-control" id="serie" name="serie" placeholder="Ejem. AA, FACT">
                    </div>
                    
                    <div class="col-md-1">
                      <label>Folio</label>
                    </div>
                    <div class="col-md-2">
                      <input type="text" class="form-control" id="folio_inicio" name="folio_inicio" placeholder="Folio inicial">
                    </div>
                    <div class="col-md-2">
                      <input type="text" class="form-control" id="folio_final" name="folio_final" placeholder="Folio final">
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>Fecha de emisión</label>
                    </div>
                    <div class="col-md-3">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="fecha_inicio" name="fecha_inicio">
                      </div>
                    </div>
                    
                    <div class="col-md-3">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="fecha_fin" name="fecha_fin">
                      </div>
                    </div>

                  </div>
                </div>
                
                <div class="form-group">
                  <div class="row">

                  </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
          </form>
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

