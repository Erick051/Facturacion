
	<style>
		
		#cont_marca,#cont_submarca,#cont_anio,#second_form,.divsub{
			display:none;
		}
	</style>


	<!--Material design color: indigo-->
	<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script-->

<div id="myModal" class="modal fade" role="dialog" >
  <div class="modal-dialog" >
		<div class="alert alert-info" style="color:#E0F7FA;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×</button>
               <span class="glyphicon glyphicon-ok"></span> <strong>Exito</strong>
                <hr class="message-inner-separator">
                <p>
                    Se ha guardado correctamente</p>
                    <div align="right">
				<br>
				<button class="btn-continuar button btn button-default btn-success" curp="">Continuar</button>
			</div>
            </div>

	</div>
</div>
	<div class="container-fluid" >
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-body">
					<form name="enviar" method="post" action="<?php echo base_url();?>index.php/facturacionTickets/Facturacion_tickets/insert_factura_global" novalidate>
					
						<!-- Clave del referido -->

						

						 <!-- Estado donde esta el auto -->				
						<div class="row">
							<div class="col-md-12">
								<label>Selecciona el tipo de ejecucion de ejecución</label>
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
								<label>Descripcion(esta parte saldrá en concepto)</label>
								<textarea name="descripcion" class="form-control" placeholder="Comentarios"></textarea><br>
								<h4>Ingresa la hora en la que quieres que se ejecute el programa</h4>
								<label>la hora es en formato de 24 horas.<br>
								por ejemplo: 23:59</label>
								<br>
								
								<select id="hora" class="form-control"  name="diarioh"><option value="00:00">00:00</option><option value="00:30">00:30</option><option value="01:00">01:00</option><option value="01:30">01:30</option><option value="02:00">02:00</option><option value="02:30">02:30</option><option value="03:00">03:00</option><option value="03:30">03:30</option><option value="04:00">04:00</option><option value="04:30">04:30</option><option value="05:00">05:00</option><option value="05:30">05:30</option><option value="06:00">06:00</option><option value="06:30">06:30</option><option value="07:00">07:00</option><option value="07:30">07:30</option><option value="08:00">08:00</option><option value="08:30">08:30</option><option value="09:00">09:00</option><option value="09:30">09:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:30">23:30</option></select>

						</div>
						<div class="form-group divsub mensual">
							<br>
								<label>Descripcion(esta parte saldrá en concepto)</label>
								<textarea name="descripcionM"  class="form-control" placeholder="Comentarios"></textarea>
								<br>
								<label>Mostrar tickets</label>

								<input type="checkbox" value="1" name="siM">

						</div>
				
						<div class="form-group divsub diario">
								<h4>Ingresa la hora en la que quieres que se ejecute el programa</h4>
								<label>la hora es en formato de 24 horas.<br>
								por ejemplo: 23:59</label>
								<br>
								<select id="hora" class="form-control"  name="diarioh"><option value="00:00">00:00</option><option value="00:30">00:30</option><option value="01:00">01:00</option><option value="01:30">01:30</option><option value="02:00">02:00</option><option value="02:30">02:30</option><option value="03:00">03:00</option><option value="03:30">03:30</option><option value="04:00">04:00</option><option value="04:30">04:30</option><option value="05:00">05:00</option><option value="05:30">05:30</option><option value="06:00">06:00</option><option value="06:30">06:30</option><option value="07:00">07:00</option><option value="07:30">07:30</option><option value="08:00">08:00</option><option value="08:30">08:30</option><option value="09:00">09:00</option><option value="09:30">09:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:30">23:30</option></select>
								<br>
								<label>Descripcion(esta parte saldrá en concepto)</label>
								<textarea name="descripcion" class="form-control" placeholder="Comentarios"></textarea>
								<br>
								<label>Mostrar tickets</label>

								<input type="checkbox" value="1" name="si">


						</div>
						
						<div id="cont_submit" class="form-group divsub enviar"> 
					    	<button type="submit" id="submit" class="btn btn-success btn-block" data-toggle="modal" target="#myModal">Enviar</button>
					    </div>
					</form>
					<hr>

				</div>
			</div>
		</div>
</div>
