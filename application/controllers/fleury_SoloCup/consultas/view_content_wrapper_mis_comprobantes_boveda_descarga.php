  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Consulta de comprobantes
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Descarga de archivo ZIP</h3>
            </div>
            <!-- /.box-header -->
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
            <form id="formulario_consulta" method="post" action="<?php echo $url_consultar_comprobantes_pss; ?>">
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <h4>Descargue aquí el archivo creado con su consulta:</h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label><a href="<?php echo $url_descarga_zip; ?>">Archivos XMLs consultados</a></label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <a href="<?php echo $url_nueva_consulta; ?>" class="btn btn-warning">Nueva consulta</a>
                </div>
              </div>
            </div>
                  

            </form>
         </div>
       </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

