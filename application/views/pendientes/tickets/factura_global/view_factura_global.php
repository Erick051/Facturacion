  <!-- Content Wrapper. Contains page content -->
  <style>
  .divsub{
  	display: none;
  }
  #leyenda{
  	color:blue;
  }
  </style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Configuración de factura global
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Factura global</a></li>
        <li class="active">Configuración</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">

    
	<?php 
    // si se guardaron los datos correctamente
    if(isset($si)){?>
		
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form name="enviar" method="post" action="<?php echo base_url();?>index.php/facturacionTickets/Facturacion_tickets/insert_factura_global" novalidate>
              <div class="box-body">
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-12">
                    <h3 class="box-title">Parámetros de ejecución del proceso de generación de factura global</h3>

					
						<!-- Clave del referido -->

						

						 <!-- Estado donde esta el auto -->				
						<div class="row">
							<div class="col-md-12">
								Los datos de configuración fueron guardados exitosamente.
							</div>
						 </div>
		
		


                  </div>
                  
                </div>

              </div>
              <!-- /.box-body -->

            </form>
          </div>
          <!-- /.box -->
        </div>


      </div>
    <?php 
    } else {
        ?>
      
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form name="enviar" method="post" action="<?php echo base_url();?>index.php/facturacionTickets/Facturacion_tickets/insert_factura_global" novalidate>
              <div class="box-body">
                <div class="row">
                  <!-- emisor -->
                  <div class="col-md-12">
                    <h3 class="box-title">Parámetros de ejecución del proceso de generación de factura global</h3>

					
						<!-- Clave del referido -->

						

						 <!-- Estado donde esta el auto -->				
						<div class="row">
							<div class="col-md-12">
								<label>Selecciona el tipo de ejecución:</label>
							</div>
							<div  class="col-md-offset-3 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group"> 
							      <select class="form-control" id="periodo" name="periodo" required>
							      <option value="">Selecciona un periodo</option>
							 			<option value="4">Mensual</option>
										<option value="2">Semanal</option>
										<option value="1">Diario</option>
										<option value="3">Quincenal</option>
									
								</select>
							    </div>

							 </div>
						
						 </div>
						 <div class="form-group divsub semanal">
							 <select class="form-control" id="semana_inicio" required>
							      <option value="">Selecciona el periodo de inicio</option>
							 			<option value="Lunes">Lunes</option>
										<option value="Martes">Martes</option>
										<option value="Miercoles">Miercoles</option>
										<option value="Jueves">Jueves</option>
										<option value="Viernes">Viernes</option>
									
								</select>
								<br><br>
								<select class="form-control" id="semana_inicio" required>
							      <option value="">Selecciona el periodo de fin</option>
							 			<option value="Lunes">Lunes</option>
										<option value="Martes">Martes</option>
										<option value="Miercoles">Miercoles</option>
										<option value="Jueves">Jueves</option>
										<option value="Viernes">Viernes</option>
									
								</select>
								<br><br>

								<h4>Selecciona la hora en la que quieres que se ejecute el programa</h4>
								
								<br>
								
								<select id="hora" class="form-control"  name="diarioh"><option value="00:00">00:00</option><option value="00:30">00:30</option><option value="01:00">01:00</option><option value="01:30">01:30</option><option value="02:00">02:00</option><option value="02:30">02:30</option><option value="03:00">03:00</option><option value="03:30">03:30</option><option value="04:00">04:00</option><option value="04:30">04:30</option><option value="05:00">05:00</option><option value="05:30">05:30</option><option value="06:00">06:00</option><option value="06:30">06:30</option><option value="07:00">07:00</option><option value="07:30">07:30</option><option value="08:00">08:00</option><option value="08:30">08:30</option><option value="09:00">09:00</option><option value="09:30">09:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:30">23:30</option></select>

						</div>
						<div class="form-group divsub diario">
								<h4>Selecciona la hora en la que quieres que se ejecute el programa</h4>
								
								<br>
								
								<select id="hora" class="form-control"  name="diarioh"><option value="00:00">00:00</option><option value="00:30">00:30</option><option value="01:00">01:00</option><option value="01:30">01:30</option><option value="02:00">02:00</option><option value="02:30">02:30</option><option value="03:00">03:00</option><option value="03:30">03:30</option><option value="04:00">04:00</option><option value="04:30">04:30</option><option value="05:00">05:00</option><option value="05:30">05:30</option><option value="06:00">06:00</option><option value="06:30">06:30</option><option value="07:00">07:00</option><option value="07:30">07:30</option><option value="08:00">08:00</option><option value="08:30">08:30</option><option value="09:00">09:00</option><option value="09:30">09:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:30">23:30</option></select>
						</div>
						<div class="divsub extra">
							<label>Descripción</label>
							<textarea name="descripcion" class="form-control" placeholder="Esta es la leyenda que aparecerá como concepto de la factura"></textarea><br>
							<br>

							<label>Mostrar números de transacciones</label>
							<input id="si_check" type="checkbox" value="1" name="si"><br>
							<label id="leyenda">Si se activa esta casilla, los números de las transacciones se concatenerán a la leyenda que aparecerá como concepto de la factura</label>
						</div>
						
						<div id="cont_submit" class="form-group divsub enviar"> 
					    	<button type="submit" id="submit" class="btn btn-success btn-block" data-toggle="modal" target="#myModal">Enviar</button>
					    </div>


                  </div>
                  
                </div>

              </div>
              <!-- /.box-body -->

            </form>
          </div>
          <!-- /.box -->
        </div>


      </div>
    <?php 
    } 
    ?>

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->