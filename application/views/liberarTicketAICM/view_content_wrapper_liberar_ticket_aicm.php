  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Liberación de tickets
      </h1>
      <ol class="breadcrumb">
    
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
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
                    <h4 class="box-title"><strong>Listado de tickets</strong></h4>
                    <label>Buscar número de ticket: </label>
                    <input type="number" name="ticket" id="ticket">
                    <input type="button" name="busca_Rfc" id="busca_Rfc" value="Buscar" onclick = "busquedaTicket(document.getElementById('ticket').value)">
                  </div>
                </div> 
            </div>
		<script>
			  function busquedaTicket(ticket){
          if(ticket==null||ticket=='')ticket="null";
				var url_buscar_rfc = "<?php echo $url_busqueda_rfc; ?>/"+ticket;
				location.href =url_buscar_rfc;
			  }
		</script>
			
              <!-- /.box-body -->

        <div class="box-footer">
         <!-- <a href="<?php echo $url_anterior; ?>" class="btn btn-danger">Cancelar</a>-->
        </div>
          

      </div>
      <!-- /.box -->
 

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->