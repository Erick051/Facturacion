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
              <h3 class="box-title">Parámetros de búsqueda</h3><span class="pull-right"><a href="<?php echo $url_nueva_consulta; ?>" class="btn btn-warning">Regresar</a></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <p>Su consulta fue registrada con los siguientes parámetros:</p>
                </div>
              </div>
            
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
            
            

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>Emisor</label>
                    </div>
                    <div class="col-md-3">
                      <p><?php echo $rfc_nombre_emisor; ?></p>
                    </div>
                    
                    <div class="col-md-1">
                      <label>Receptor</label>
                    </div>
                    <div class="col-md-4">
                      <?php echo $rfc_nombre_receptor; ?>
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
                      <?php
                        switch ($estatus_comprobante) {
                            case -1:
                              echo "Todos";
                              break;
                            case 1:
                              echo "Vigentes";
                              break;
                              
                            case 0:
                              echo "Cancelados";
                              break;
                        }
                      ?>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>Serie</label>
                    </div>
                    <div class="col-md-3">
                      <?php echo $serie; ?>
                    </div>
                    
                    <div class="col-md-1">
                      <label>Folio</label>
                    </div>
                    <div class="col-md-2">
                      <?php echo $folio_inicio; ?>
                    </div>
                    <div class="col-md-2">
                      <?php echo $folio_final; ?>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-2">
                      <label>Fecha de emisión</label>
                    </div>
                    <div class="col-md-3">
                      <?php echo $fecha_inicio; ?>
                    </div>
                    
                    <div class="col-md-3">
                      <?php echo $fecha_fin; ?>
                    </div>

                  </div>
                </div>
                
                <div class="form-group">
                  <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> ¡Atención!</h4>
                      Su reporte será generado en segundo plano. Se le enviará un correo electrónico cuando el proceso haya concluido con una liga para descargar el mismo. Adicionalmente podrá recuperarlo más tarde en la opción Descargar reportes del menú consultas.
                  </div>
                </div>

            </div>
            <!-- /.box-body -->
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

