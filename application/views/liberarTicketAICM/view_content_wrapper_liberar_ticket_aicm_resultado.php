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
                        }				if ($arr_tickets != null){

                        ?>                    <h4 class="box-title"><strong>Listado de tickets</strong></h4>
						                    <label>Seleccione el ticket que desea liberar:  </label>
						  <?php
                        }else { 

                        ?>  
						
						<h4 class="box-title"><strong>No se encontró ningún resultado</strong></h4>
						<label>Vuelva a intentar la busqueda con otro parámetro</label>
											
											
						<?php
                        }

                        ?>  

                  </div>
                </div>
				
				<div class="box-footer">
				<a href="javascript:history.back(1)" class="btn btn-danger">Volver a buscar</a>
				</div>
               <?php
                $escribir_row = true;
                $columnas = 1;
				
				if ($arr_tickets != null){
                for($i = 1; $i <= count($arr_tickets); $i++) {
                    if ( $escribir_row ) {
                        echo '<div class="row">';
                    }
                    echo '<div class="col-md-6">';
                    $capturar_datos_facturacion = $url_captura_datos_facturacion."/".$arr_tickets[$i]->id_trx_erp;
                    echo '  <a class="btn btn-block btn-default btn-lg" href="'.$capturar_datos_facturacion.'">';
                    echo '    <br><b>Número de ticket: '.$arr_tickets[$i]->id_trx_erp.'</b>';
                    echo '    <br>Serie: '.$arr_tickets[$i]->serie;
                    echo '    <br>Folio: '.$arr_tickets[$i]->folio;
                    echo '    <br>Subtotal: '.$arr_tickets[$i]->subtotal;
                    echo '    <br>Total: '.$arr_tickets[$i]->total;
                    echo '    <hr>';
                    echo '  </a>';
                    echo '</div>';
                    
                    $columnas++;
                    
                    if ($columnas > 1 && $columnas < 3) {
                        $escribir_row = false;
                    } else {
                        $escribir_row = true;
                        $columnas = 1;
                    }
                    if ( $escribir_row ) {
                        echo '</div>';
                        echo '<br>';
                    }
				}
             }
                ?>
            </div>
		<script>
			  function busquedaTicket(ticket){
				alert('rfc: '+ticket)
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