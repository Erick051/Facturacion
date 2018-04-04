
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Configuración de mapeo de CSV 
        <small> Emsión de recibo de nómina con complemento versión 1.2</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Configuración</a></li>
        <li><a href="#">Layout CSV</a></li>
        <li class="#">Nómina 1.2</li>
        <li class="active">Cargar archivo</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <form name="config_carga_archivo" class="form-horizontal" id="formulario_config_carga_archivo_csv" method="post" action="<?php echo $url_validar_archivo_csv_nomina12; ?>" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Configuración de carga de archivo</h3>
          <p>Elija un archivo csv de demostración para generar el mapeo del layout. El archivo deberá contener <strong>SÓLO DOS LÍNEAS</strong>, una indicando los campos a manera de encabezado y una línea conteniendo datos de acuerdo a la configuración del encabezado</p>
        </div>
        <div class="box-body">
          <?php if ( isset( $mensaje_error ) ) {
          ?>
          <div class="callout callout-info">
            <h4>Verifique por favor</h4>
          
            <p><?php echo $mensaje_error; ?></p>
          </div>
          <?php
          }
          ?>
        
          <div class="row">
            <div class="col-md-12">
               <?php /*
                 <div class="form-group">
                    <label class="col-sm-2 control-label">Número de línea del encabezado</label>
                    <div class="col-sm-2">
                       <input type="hidden" id="num_linea_encabezado" name="num_linea_encabezado" value="1" class="form-control"/>
                    </div>
                 </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">Número de línea de los datos ejemplo</label>
                    <div class="col-sm-2">
                       <input type="hidden" id="num_linea_datos" name="num_linea_datos" value="2" class="form-control"/>
                    </div>
                 </div>
                 */
                 ?>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">Separador</label>
                    <div class="col-sm-2">
                       <input type="text" id="separador" name="separador" value="," class="form-control"/>
                    </div>
                 </div>

                 <div class="form-group">
                    <label class="col-sm-2 control-label">Delimitador de columna</label>
                    <div class="col-sm-2">
                       <input type="text" id="delimitador_columna" name="delimitador_columna" value='"' class="form-control"/>
                    </div>
                 </div>

                 <div class="form-group">
                    <label class="col-sm-2 control-label">Archivo muestra</label>
                    <div class="col-sm-2">
                       <input type="file" id="archivo_muestra_mapeo_csv" name="archivo_muestra_mapeo_csv">
                    </div>
                 </div>
                 
               

            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Cargar</button> <a href="<?php echo $url_anterior; ?>" class="btn btn-warning"><i class="fa fa-reply"></i> Regresar</a>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
      </form>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
