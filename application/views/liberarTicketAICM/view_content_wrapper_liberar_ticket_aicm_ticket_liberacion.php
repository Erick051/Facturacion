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
				<h1 align="center" class="box-title"><strong>Ticket liberado correctamente:</strong></h1>

               <?php
                $escribir_row = true;
                $columnas = 1;
				?>
				
				<?PHP
                for($i = 1; $i <= count($arr_ticketsLiberar); $i++) {
					$capturar_datos_facturacion;
                    if ( $escribir_row ) {
                        echo '<div class="row" align="center" >';
                    }
                    echo '<div class="col-md-12">';
                    echo '    <br>Número de ticket: '.$arr_ticketsLiberar[$i]->id_trx_erp;
                    echo '    <br>Serie: '.$arr_ticketsLiberar[$i]->serie;
                    echo '    <br>Folio: '.$arr_ticketsLiberar[$i]->folio;
                    echo '    <br>Fecha: '.$arr_ticketsLiberar[$i]->fecha;
                    echo '    <br>Subtotal: '.$arr_ticketsLiberar[$i]->subtotal;
                    echo '    <br>Total: '.$arr_ticketsLiberar[$i]->total;
                    echo '    <hr>';
                    echo '  </a>';
				?>
				<div class="box-footer">
				<a href="<?PHP echo $capturar_datos_facturacion; ?>" class="btn btn-success">Volver al menú principal</a>
				</div>
				<?PHP
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