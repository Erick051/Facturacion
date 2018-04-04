  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mis comprobantes emitidos
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Generación de reporte de consulta realizada</h3>
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
            <form id="formulario_consulta" method="post" action="<?php echo $url_consultar_comprobantes_pss_2oplano; ?>">
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <h4><?php echo $leyenda_descarga; ?></h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <a href="<?php echo $url_anterior; ?>" class="btn btn-warning"><i class="fa fa-reply"></i> Cambiar la consulta</a>
                    </div>
                    <div class="col-md-3">
                      <a href="javascript:void(0)" onclick="segundo_plano(1);" class="btn btn-default"><i class="fa fa-envelope"></i> Enviar los resultados por correo</a>
                    </div>
                    <div class="col-md-3">
                      <a href="javascript:void(0)" onclick="segundo_plano(2);" class="btn btn-primary"><i class="fa fa-download"></i> Descargar el resultado en archivo zip</a>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <div class="form-group" id="formulario_entrega">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <h4>Enviar por correo</h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      Escriba la dirección de correo electrónico del destinatario de la consulta. Se enviará un mensaje con el archivo zip conteniendo los xmls consultados:
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <input type="text" name="email_destinatario" id="email_destinatario" class="form-control">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <input type="submit" class="btn btn-success" value="Aceptar">
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <input type="hidden" name="id_consulta" id="id_consulta" value="<?php echo $id_consulta; ?>">
            <input type="hidden" name="tipo_consulta" id="tipo_consulta">

            </form>
            <!-- /.box-body -->
          </div>
        </diV>
 
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

