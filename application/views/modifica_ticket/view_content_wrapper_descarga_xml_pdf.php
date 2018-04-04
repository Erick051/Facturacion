  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Facturación de tickets
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Facturación</a></li>
        <li class="active">Descarga de XML y PDF</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Su transacción ha sido procesada y estará disponible en breve.</h3>
        </div>
        <div class="box-body">
        
                <div class="row">
                  <div class="col-md-12">
                        <?php
                        if ( isset($titulo) ) {
                        ?>
                          <div class="<?php echo $tipo_mensaje; ?>">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-exclamation-circle"></i> <?php echo $titulo; ?></h4>
                            <?php echo $mensaje; ?>
                          </div>
                        <?php
                        }
                        ?>
                  </div>
                </div>
        
          <div class="row" id="div_espera">
            <div class="col-md-12">
              <div class="overlay">
                 <i class="fa fa-refresh fa-spin"></i> Su comprobante fiscal digital se está generando. Espere unos segundos por favor...
              </div>
            </div>
          </div>
          <br>
          <div class="row" id="div_descarga" style="display: none;">
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-6 text-center">
                Descargue su XML aquí
                </div>
                <div class="col-md-6 text-center">
                Descargue su PDF aqui
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                   <a class="btn btn-lg btn-block btn-info" href="<?php echo $url_descargar_xml; ?>">
                      <i class="fa fa-file-code-o"></i> XML
                   </a>
                </div>
                <div class="col-md-6">
                   <a class="btn btn-lg btn-block btn-danger" href="<?php echo $url_descargar_pdf; ?>">
                      <i class="fa fa-file-pdf-o"></i> PDF
                   </a>
                </div>
              </div>

            </div>
          </div>       

          </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo $url_nueva_factura; ?>" class="btn btn-success">Facturar otro ticket</a>
        </div>
        </form>
        <!-- /.box-footer-->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->