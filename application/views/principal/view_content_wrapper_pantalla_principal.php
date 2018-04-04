  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $titulo_pantalla_principal; ?>
      </h1>
      <ol class="breadcrumb">
        <li class="active"> Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Bienvenido</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>

          </div>
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
           <span><?php echo $config_portal->aviso_principal; ?></span>
        </div>
      </div>
          
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

