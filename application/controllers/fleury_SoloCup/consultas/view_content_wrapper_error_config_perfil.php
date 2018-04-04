  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Consulta de comprobantes
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Consultas</a></li>
        <li class="active">Configuración pendiente</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">No se puede continurar con la consulta</h3>
          
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
        
          <div class="row">
            <div class="col-md-12">
             <span><?php echo $mensaje_error; ?></span>
            </div>
           

          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo $url_anterior; ?>" class="btn btn-danger">Cancelar</a>
        </div>
        <!-- /.box-footer-->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->